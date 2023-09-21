<?php

    // use MembersRepositoryInterface;
    namespace App\Repositories\Eloquent;
    use App\Repositories\MembersRepositoryInterface;
    use App\Models\Member;

    Class MembersRepository implements MembersRepositoryInterface{
        private $model;

        public function __construct(Member $model)
        {
            $this->model = $model;
        }

        public function getAll(){
            return $this->model->all();
        }
    }
?>