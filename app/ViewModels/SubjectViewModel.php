<?php
declare(strict_types=1);

namespace App\ViewModels;

use Akbarali\DataObject\DataObjectBase;
use Akbarali\ViewModel\BaseViewModel;
use App\DataObject\SubjectData;
use Illuminate\Support\Collection;

class SubjectViewModel extends BaseViewModel
{
    public int     $id;
    public int     $user_id;
    public string  $title;
    public ?string $description;
    public ?string  $createdAt;
    public int  $topicCount = 0;

    protected DataObjectBase|SubjectData $_data;

    protected function populate(): void
    {
        $this->createdAt = $this->_data->created_at->format('d.m.Y H:i');
        $this->topicCount = count($this->_data->topics);
    }

    public function setRolesList(Collection $roleList): void
    {
        $this->listOfRoles = $roleList->transform(fn(RoleData $item) => new \App\ViewModels\User\RoleViewModel($item));
    }

}
