<?php

namespace Helpers;

use Database\MySQLWrapper;
use Exception;

class DatabaseHelper
{
    public static function getRandomComputerPart(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM computer_parts ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $part = $result->fetch_assoc();

        if (!$part) throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function getComputerPartById(int $id): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $part = $result->fetch_assoc();

        if (!$part) throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function getTypes(string $type, int $page, int $perpage): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = ?");
        $stmt->bind_param('s', $type);
        $stmt->execute();

        $result = $stmt->get_result();
        $types = $result->fetch_all(MYSQLI_ASSOC);

        if (!$types) throw new Exception('Could not find a single part in database');

        return $types;
    }

    public static function getRandomComputer(): array{
        $db = new MySQLWrapper();
        $res = [];

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = 'CPU' ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $cpu = $result->fetch_assoc();
        if (!$cpu) throw new Exception('Could not find a single part in database');
        $res[] = $cpu;

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = 'GPU' ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $gpu = $result->fetch_assoc();
        if (!$gpu) throw new Exception('Could not find a single part in database');
        $res[] = $gpu;

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = 'SSD' ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $ssd = $result->fetch_assoc();
        if (!$ssd) throw new Exception('Could not find a single part in database');
        $res[] = $ssd;

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = 'RAM' ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $ram = $result->fetch_assoc();
        if (!$ram) throw new Exception('Could not find a single part in database');
        $res[] = $ram;

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = 'Motherboard' ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $motherBoard = $result->fetch_assoc();
        if (!$motherBoard) throw new Exception('Could not find a single part in database');
        $res[] = $motherBoard;

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = 'Storage' ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $storage = $result->fetch_assoc();
        if (!$storage) throw new Exception('Could not find a single part in database');
        $res[] = $storage;

        return $res;
    }

    public static function getPerformance(string $order, string $type): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = ? ORDER BY type $order LIMIT 50");
        $stmt->bind_param('s', $type);
        $stmt->execute();

        $result = $stmt->get_result();
        $types = $result->fetch_all(MYSQLI_ASSOC);

        if (!$types) throw new Exception('Could not find a single part in database');

        return $types;
    }
}