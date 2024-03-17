<?php
declare(strict_types=1);

namespace App\ViewModels;

use Akbarali\DataObject\DataObjectBase;
use Akbarali\ViewModel\BaseViewModel;
use App\DataObject\SubjectData;
use App\DataObject\TopicData;
use Illuminate\Support\Collection;

class TopicViewModel extends BaseViewModel
{
    public ?int    $id;
    public int     $user_id;
    public ?int    $subject_id;
    public ?string $title;
    public ?string $content;

    public ?string $createdAt;

    protected DataObjectBase|TopicData $_data;

    public ?SubjectViewModel $subject;


    protected function populate(): void
    {
        $this->createdAt = $this->_data->created_at->format('d.m.Y H:i');
    }

    public function setSubject(SubjectData $subjectData): void
    {
        $this->subject_id = $subjectData->id;
        $this->subject    = new SubjectViewModel($subjectData);
    }


}
