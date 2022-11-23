<?php

require_once 'utilities/Model.php';

class Task  extends Model
{
    private int $id;
    private string $name;
    private string $to_do_at; // TODO change type
    private bool $is_done;
    private int $id_user;



    // accesseurs (getters & setters)

    /**
     * Permet de récupérer l'identifiant de la tâche
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getToDoAt(): string
    {
        return $this->to_do_at;
    }

    /**
     * @param string $to_do_at
     * @return void
     */
    public function setToDoAt(string $to_do_at): void
    {
        $this->to_do_at = $to_do_at;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->is_done;
    }

    /**
     * @param bool $is_done
     * @return void
     */
    public function setIsDone(bool $is_done): void
    {
        $this->is_done = $is_done;
    }


    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     * @return void
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * La méthode permet de récupérer une tâche suivant un ID task
     *
     * @param int $id
     * @return self|false
     */
    public function getOneById(int $id): self|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE id = :id ");
        $stmt->bindParam(':id', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        $stmt->execute();
        return $stmt->fetch();
    }
    /**
     * La méthode permet de récupérer les tâches d'un utilisateur
     *
     * @param int $id_user
     * @return self|false
     */
    public function getOneByIdUser(int $id_user): self|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE id_user = :id_user ");
        $stmt->bindParam(':id', $id_user);
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        $stmt->execute();
        return $stmt->fetch();
    }
    /**
     * La méthode permet de supprimer une tâche suivant un ID task
     *
     * @param int $id
     * @return self|false
     */
    public function deleteOneById(int $id): self|false
    {
        $stmt = $this->pdo->prepare("DELETE FROM task WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        $stmt->execute();
        return $stmt->fetch();
    }
    /**
     * La méthode permet de mettre à jour une tâche comme faite suivant un ID task
     *
     * @param int $id
     * @return self|false
     */
    public function taskIsDone(int $id): self|false
    {
        $stmt = $this->pdo->prepare("UPDATE TASK SET is_done = 1 WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        $stmt->execute();
        return $stmt->fetch();
    }
    /**
     * La méthode d'ajouter une tâche
     *
     * @param int $id_user
     * @param string $name
     */
    public function addTask(
        $name,
        $id_user,
    ) {
        $stmt = $this->pdo->prepare("INSERT INTO `task` (`name`, `id_user`) VALUES (:name, :id)");
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        $stmt->execute([
            'name' => $name,
            'id' => $id_user,
        ]);
        return $stmt->fetch();
    }
    /**
     * La méthode de modifier une tache
     *
     * 
     * @param int $id
     * @param string $new_name
     * @return self|false
     */
    public function editTask(
        $id,
        $new_name
    ): self|false {
        $stmt = $this->pdo->prepare("UPDATE task SET `name` = :new_name WHERE id = :id");
        $stmt->execute([
            'new_name' => $new_name,
            'id' => $id,
        ]);
        $stmt->execute();
        return $stmt->fetch();
    }
}
