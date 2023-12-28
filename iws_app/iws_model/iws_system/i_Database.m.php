<?php

    class Database{
        private $host;
        private $username;
        private $password;
        private $database;
        private $connection;

        public function __construct($host, $username, $password, $database)
        {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;

            $this->connect();
        }

        private function connect()
        {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
        }

        public function disconnect()
        {
            $this->connection->close();
        }

        public function insert($table, $data)
        {
            $columns = implode(", ", array_keys($data));
            $values = implode(", ", array_fill(0, count($data), "?"));
            $query = "INSERT INTO $table ($columns) VALUES ($values)";

            return $this->executePreparedStatement($query, array_values($data));
        }

        public function select($table, $columns = "*", $where = null)
        {
            $query = "SELECT $columns FROM $table";

            if ($where !== null) {
                $query .= " WHERE $where";
            }

            return $this->fetchResults($query);
        }

        public function update($table, $data, $where)
        {
            $updateData = [];
            foreach ($data as $key => $value) {
                $updateData[] = "$key = ?";
            }

            $setClause = implode(", ", $updateData);
            $query = "UPDATE $table SET $setClause WHERE $where";

            return $this->executePreparedStatement($query, array_values($data));
        }

        public function delete($table, $where)
        {
            $query = "DELETE FROM $table WHERE $where";

            return $this->executeQuery($query);
        }

        private function executeQuery($query)
        {
            $result = $this->connection->query($query);

            if ($result === false) {
                die("Query failed: " . $this->connection->error);
            }

            return $result;
        }

        private function executePreparedStatement($query, $values)
        {
            $stmt = $this->connection->prepare($query);

            if (!$stmt) {
                die("Error in prepared statement: " . $this->connection->error);
            }

            // Dynamische Anzahl von Parametern binden
            if ($values) {
                $types = str_repeat('s', count($values)); // Annahme, dass alle Parameter vom Typ String sind
                $stmt->bind_param($types, ...$values);
            }

            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();

            return $result;
        }

        private function fetchResults($query)
        {
            $result = $this->executeQuery($query);
            $rows = [];

            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            return $rows;
        }
    }