<?php

namespace view;

class EventJsonView implements View
{
    public function show(array $data)
    {
        header('Content-Type: application/json');

        if (isset($data['event'])) {
            $Event = $data['event'];
            echo json_encode(['id' => $Event->getId(), 'name' => $Event->getName()]);
        } else {
            echo '{}';
        }
    }
}
