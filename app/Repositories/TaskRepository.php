<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{

    # visszaadja a megadott User-hez tartozó Task-okat a szűrési feltételek alapján
    public function getAllByUser(User $user, array $filters = []): Collection
    {
        return $user->tasks() # a User modellben definiált tasks() kapcsolatot használjuk, hogy lekérjük a User-hez tartozó Task-okat
            ->filterByStatus($filters['status'] ?? null) # a filterByStatus scope-ot használjuk, hogy szűrjük a Task-okat a státusz alapján
            ->filterByPriority($filters['priority'] ?? null) # a filterByPriority scope-ot használjuk, hogy szűrjük a Task-okat a prioritás alapján
            ->filterByDueDate($filters['dueDate'] ?? null) # a filterByDueDate scope-ot használjuk, hogy szűrjük a Task-okat a határidő alapján
            ->get();
    }

    public function getById(int $id): Task
    {
        return  Task::findOrFail($id);
    }


    public function store(User $user, array $data): Task
    {
        return $user->tasks()->create($data); # a User modellben definiált tasks() kapcsolatot használjuk, hogy létrehozzunk egy új Task-ot a megadott adatokkal
    }


    public function update(Task $task, array $data): Task
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }

}
