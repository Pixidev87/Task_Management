<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{

    public function __construct(private readonly TaskRepository $taskRepository){}

    # visszaadja a megadott User-hez tartozó Task-okat a szűrési feltételek alapján
    public function getAllByUser(User $user, array $filters = []): Collection
    {
        return $this->taskRepository->getAllByUser($user, $filters);
    }

    # visszaadja a megadott id-vel rendelkező Task-ot
    public function store(User $user, array $data): Task
    {
        # az isset függvénnyel ellenőrizzük, hogy a data tömbben van-e due_date kulcs, és ha igen, akkor összehasonlítjuk a jelenlegi idővel. Ha a due_date értéke kisebb, mint a jelenlegi idő, akkor kivételt dobunk, mert a határidő nem lehet múltbéli.
        if( isset($data['due_date']) && $data['due_date'] < now() ){
            throw new Exception("A határidő nem lehet múltbéli");
        }
        # a TaskRepository store metódusát hívjuk meg, hogy létrehozzunk egy új Task-ot a megadott adatokkal, és visszaadjuk a létrehozott Task-ot.
        return $this->taskRepository->store($user, $data);
    }

    # frissíti a megadott Task-ot a megadott adatokkal, és visszaadja a frissített Task-ot
    public function update(User $user , Task $task, array $data): Task
    {
        # először ellenőrizzük, hogy a Task-ot a megadott User hozta-e létre, azaz hogy a Task user_id mezője megegyezik-e a User id-jával. Ha nem egyezik, akkor kivételt dobunk, mert nincs jogosultságunk módosítani ezt a feladatot.
        if($task->user_id !== $user->id){
            throw new Exception("Nincs jogosultságod módosítani ezt a feladatot");
        }
        # az isset függvénnyel ellenőrizzük, hogy a data tömbben van-e due_date kulcs, és ha igen, akkor összehasonlítjuk a jelenlegi idővel. Ha a due_date értéke kisebb, mint a jelenlegi idő, akkor kivételt dobunk, mert a határidő nem lehet múltbéli.
        if (isset($data['due_date']) && $data['due_date'] < now() ) {
            throw new Exception("Nincs határidő vagy nem lehet múltbéli");
        }
        # a TaskRepository update metódusát hívjuk meg, hogy frissítsük a megadott Task-ot a megadott adatokkal, és visszaadjuk a frissített Task-ot.
        return $this->taskRepository->update($task, $data);
    }


    public function delete(User $user, Task $task): bool
    {
        if($task->user_id !== $user->id){
            throw new Exception("Nincs jogosultságod törölni ezt a feladatot!");
        }

        return $this->taskRepository->delete($task);
    }
}
