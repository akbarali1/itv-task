<?php
declare(strict_types=1);

namespace App\ViewModels;

use Akbarali\DataObject\DataObjectBase;
use Akbarali\ViewModel\BaseViewModel;
use App\DataObject\SubjectData;
use App\DataObject\TopicData;
use Illuminate\Support\Collection;

class SubjectViewModel extends BaseViewModel
{
    public int     $id;
    public int     $user_id;
    public string  $title;
    public ?string $description;
    public ?string $createdAt;
    public int     $topicCount = 0;

    /** @var array|Collection<TopicViewModel> */
    public Collection|array             $listOfTopic = [];

    protected DataObjectBase|SubjectData $_data;

    protected function populate(): void
    {
        $this->createdAt  = $this->_data->created_at->format('d.m.Y H:i');
        $this->topicCount = count($this->_data->topics);
    }

    public function setTopicList(Collection $roleList): void
    {
        $this->listOfTopic = $roleList->transform(fn(TopicData $item) => new TopicViewModel($item));
    }

}
