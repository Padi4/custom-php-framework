<?php
namespace App\Model;

use App\Service\Config;

class Report
{
    private ?int $id = null;
    private ?string $reporter = null;
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Report
    {
        $this->id = $id;

        return $this;
    }

    public function getReporter(): ?string
    {
        return $this->reporter;
    }

    public function setReporter(?string $reporter): Report
    {
        $this->reporter = $reporter;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Report
    {
        $this->description = $description;

        return $this;
    }

    public static function fromArray($array): Report
    {
        $report = new self();
        $report->fill($array);

        return $report;
    }

    public function fill($array): Report
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['reporter'])) {
            $this->setReporter($array['reporter']);
        }
        if (isset($array['description'])) {
            $this->setDescription($array['description']);
        }

        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM report';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $reports = [];
        $reportsArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($reportsArray as $reportsArray) {
            $reports[] = self::fromArray($reportsArray);
        }

        return $reports;
    }

    public static function find($id): ?Report
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM report WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $reportsArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $reportsArray) {
            return null;
        }
        $report = Report::fromArray($reportsArray);

        return $report;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getId()) {
            $sql = "INSERT INTO report (reporter, description) VALUES (:reporter, :description)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'reporter' => $this->getReporter(),
                'description' => $this->getDescription(),
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE report SET reporter = :reporter, description = :description WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':reporter' => $this->getReporter(),
                ':description' => $this->getDescription(),
                ':id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM report WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setReporter(null);
        $this->setDescription(null);
    }
}
