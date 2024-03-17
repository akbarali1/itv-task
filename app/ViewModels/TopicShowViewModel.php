<?php
declare(strict_types=1);

namespace App\ViewModels;

use Akbarali\DataObject\DataObjectBase;
use Akbarali\ViewModel\BaseViewModel;
use App\DataObject\CreateTopicData;
use App\DataObject\SubjectData;
use App\DataObject\TopicData;
use Illuminate\Support\Collection;

class TopicShowViewModel extends BaseViewModel
{
    public ?int    $id;
    public int     $user_id;
    public ?int    $subject_id;
    public ?string $title;
    public ?string $content;
    public ?string $hContent;

    public ?string $createdAt;

    protected DataObjectBase|TopicData $_data;

    public ?SubjectViewModel $subject;


    protected function populate(): void
    {
        $this->createdAt = $this->_data->created_at->format('d.m.Y H:i');
        $this->hContent  = isset($this->content) ? nl2br($this->content) : trans('form.no_content');
    }

}
