<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\TopicStoreActionData;
use App\DataObject\CreateTopicData;
use App\Exceptions\OperationException;
use App\Filters\SubjectFilter;
use App\Services\SubjectService;
use App\Services\TopicService;
use App\ViewModels\SubjectViewModel;
use App\ViewModels\TopicViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class TopicController extends Controller
{
    public function __construct(
        protected TopicService $service,
        protected SubjectService $subjectService
    ) {}

    /**
     * @param int     $subjectId
     * @param Request $request
     * @return View
     * @throws OperationException
     */
    public function index(int $subjectId, Request $request): View
    {
        $filters = collect();
        $filters->push(SubjectFilter::getFilter($subjectId));
        $dataCollection = $this->service->paginate((int)$request->get('page', 1), 25, $filters);

        return (new PaginationViewModel($dataCollection, TopicViewModel::class))->toView('topic.index', [
            'subject' => new SubjectViewModel($this->subjectService->getSubject($subjectId)),
        ]);
    }

    /**
     * @param int     $subjectId
     * @param Request $request
     * @return View
     * @throws OperationException
     */
    public function create(int $subjectId, Request $request): View
    {
        $topicData = CreateTopicData::createFromArray([
            'subject_id' => $subjectId,
            'user_id'    => $request->user()->id,
        ]);
        $viewModel = new TopicViewModel($topicData);
        $viewModel->setSubject($this->subjectService->getSubject($subjectId));

        return $viewModel->toView('topic.store');
    }

    /**
     * @param int     $subjectId
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(int $subjectId, Request $request): RedirectResponse
    {
        try {
            $request->request->add([
                'user_id'    => $request->user()->id,
                'subject_id' => $subjectId,
            ]);
            $this->service->store(TopicStoreActionData::createFromRequest($request));

            return to_route('subject.topic.index', ['subject_id' => $subjectId])->with('message', trans('all.created'));
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * @param int $subjectId
     * @param int $id
     * @return View
     * @throws OperationException
     */
    public function edit(int $subjectId, int $id): View
    {
        $topicData = $this->service->getTopic($id);
        $viewModel = new TopicViewModel($topicData);

        $viewModel->setSubject($this->subjectService->getSubject($subjectId));

        return $viewModel->toView('topic.store');
    }

    /**
     * @param int     $subjectId
     * @param int     $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $subjectId, int $id, Request $request): RedirectResponse
    {
        try {
            $request->request->add([
                'id'         => $id,
                'user_id'    => $request->user()->id,
                'subject_id' => $subjectId,
            ]);

            $this->service->store(TopicStoreActionData::createFromRequest($request));

            return to_route('subject.topic.index', ['subject_id' => $subjectId])->with('message', trans('all.updated'));
        } catch (\Throwable $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * @param int $subjectId
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $subjectId, int $id): RedirectResponse
    {
        try {
            $this->service->delete($id);

            return back()->with('message', trans('form.deleted'));
        } catch (\Throwable $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }
}
