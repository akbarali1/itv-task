<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\ActionData\ActionDataException;
use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\TopicStoreActionData;
use App\DataObject\TopicData;
use App\Exceptions\OperationException;
use App\Models\TopicModel;
use Illuminate\Validation\ValidationException;

class TopicService
{

    /**
     * @param int           $page
     * @param int           $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = null): DataObjectCollection
    {
        $model = TopicModel::applyEloquentFilters($filters)->latest();
        $model->select(['topics.*']);

        $totalCount = $model->count();
        $skip       = $limit * ($page - 1);
        $items      = $model->skip($skip)->take($limit)->get();
        $items->transform(fn(TopicModel $value) => TopicData::fromModel($value));

        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    /**
     * @param TopicStoreActionData $actionData
     * @return TopicData
     * @throws ActionDataException
     * @throws ValidationException
     */
    public function store(TopicStoreActionData $actionData): TopicData
    {
        if (isset($actionData->id)) {
            $topic = TopicModel::query()->find($actionData->id);
            $actionData->addValidationRule('id', 'required|exists:topics,id');
        } else {
            $topic = new TopicModel();
        }
        $actionData->validateException();

        $topic->fill($actionData->toArray());
        $topic->save();

        return TopicData::fromModel($topic);
    }

    /**
     * @param int $id
     * @return TopicData
     * @throws OperationException
     */
    public function getTopic(int $id): TopicData
    {
        /** @var TopicModel $user */
        $topic = TopicModel::query()->find($id);
        if (is_null($topic)) {
            throw new OperationException("Subject not found");
        }

        return TopicData::fromModel($topic);
    }

    /**
     * @param int $id
     * @return void
     * @throws OperationException
     */
    public function delete(int $id): void
    {
        /** @var TopicModel $user */
        $topic = TopicModel::query()->find($id);

        if (is_null($topic)) {
            throw new OperationException("Topic not found");
        }

        $topic->delete();
    }

}
