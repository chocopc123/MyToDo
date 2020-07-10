<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Todo;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=10; $i++){
            $todo = new Todo;
            $todo->title = 'ToDoタイトル' . $i;
            $todo->explanation = 'ToDo説明' . $i;
            $todo->difficulty = 1;
            $todo->importance = 2;
            $todo->complete = false;
            $todo->deadline = date("Y/m/d", strtotime("+7 day"));
            $todo->save();
        }
    }
}
