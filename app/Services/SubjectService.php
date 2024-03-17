<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\ActionData\ActionDataException;
use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\SubjectStoreActionData;
use App\DataObject\SubjectData;
use App\Exceptions\OperationException;
use App\Models\SubjectModel;
use Illuminate\Validation\ValidationException;

final class SubjectService
{

    /**
     * @param int           $page
     * @param int           $limit
     * @param iterable|null $filters
     * @return DataObjectCollection<SubjectData>
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = null): DataObjectCollection
    {
        $model = SubjectModel::applyEloquentFilters($filters, ['topics'])->latest();
        $model->select(['subjects.*']);

        $totalCount = $model->count();
        $skip       = $limit * ($page - 1);
        $items      = $model->skip($skip)->take($limit)->get();
        $items->transform(fn(SubjectModel $value) => SubjectData::fromModel($value));

        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param SubjectStoreActionData $actionData
     * @return SubjectData
     * @throws ActionDataException
     * @throws ValidationException
     */
    public function store(SubjectStoreActionData $actionData): SubjectData
    {
        if (isset($actionData->id)) {
            $subject = SubjectModel::query()->find($actionData->id);
            $actionData->addValidationRule('id', 'required|exists:subjects,id');
        } else {
            $subject = new SubjectModel();
        }
        $actionData->validateException();

        $subject->fill($actionData->toArray());
        $subject->save();

        return SubjectData::fromModel($subject);
    }

    /**
     * @param int $id
     * @return SubjectData
     * @throws OperationException
     */
    public function getSubject(int $id): SubjectData
    {
        /** @var SubjectModel $user */
        $subject = SubjectModel::query()->find($id);
        if (is_null($subject)) {
            throw new OperationException("Subject not found", OperationException::ERROR_NOT_FOUND);
        }

        return SubjectData::fromModel($subject);
    }

    /**
     * @param int $id
     * @return void
     * @throws OperationException
     */
    public function delete(int $id): void
    {
        /** @var SubjectModel $subject */
        $subject = SubjectModel::query()->find($id);

        if (is_null($subject)) {
            throw new OperationException("Subject not found", OperationException::ERROR_NOT_FOUND);
        }
        $subject->topics()->delete();
        $subject->delete();
    }

}
