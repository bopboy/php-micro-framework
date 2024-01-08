<?php

namespace Onedb\Session;
use Onedb\Database\Adaptor;

class DatabaseSessionHandler implements \SessionHandlerInterface {
    private $savePath;
    public function open($savePath, $sessionName): bool {
        $this->savePath = $savePath;
        return true;
    }
    public function close(): bool {
        return true;
    }
    public function read($id) : string {
        $data = current(Adaptor::getAll('SELECT * FROM sessions WHERE id = ?', [$id]));
        if($data) {
            $payload = $data->payload;
        } else {
            Adaptor::exec('INSERT INTO sessions(id) VALUES (?)',[$id]);
        }
        return $payload ?? '';
    }
    public function write($id, $payload) : bool {
        return Adaptor::exec('UPDATE sessions SET payload = ? WHERE id = ?', [$payload, $id] );
    }
    public function destroy($id) : bool {
        return Adaptor::exec('DELETE FROM sessions WHERE id = ?', [$id]);
    }
    public function gc($maxlifetime) : bool {
        if($sessions = Adaptor::getAll(('SELECT * FROM sessions'))) {
            foreach($sessions as $session) {
                $timestamp = strtotime($session->created_at);
                if(time() - $timestamp > $maxlifetime) {
                    $this->destroy(($session->id));
                }
            }
            return true;
        }
        return false;
    }
}

