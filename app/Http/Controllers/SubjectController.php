<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\SubjectStoreActionData;
use App\Exceptions\OperationException;
use App\Services\SubjectService;
use App\ViewModels\SubjectViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class SubjectController extends Controller
{
    public function __construct(
        protected SubjectService $service
    ) {}

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters        = collect();
        $dataCollection = $this->service->paginate((int)$request->get('page', 1), 25, $filters);

        return (new PaginationViewModel($dataCollection, SubjectViewModel::class))->toView('subject.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('subject.store');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->request->set('user_id', $request->user()->id);
            $this->service->store(SubjectStoreActionData::createFromRequest($request));

            return to_route('subject.index')->with('message', trans('all.saved'));
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return View|RedirectResponse
     */
    public function edit(int $id): View|RedirectResponse
    {
        try {
            $subjectData = $this->service->getSubject($id);
            $viewModel   = new SubjectViewModel($subjectData);

            return $viewModel->toView('subject.store');
        } catch (\Throwable $th) {
            return to_route('subject.index')->withErrors($th->getMessage());
        }
    }

    /**
     * @param int     $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        try {
            $request->request->add([
                'id'      => $id,
                'user_id' => $request->user()->id,
            ]);
            $this->service->store(SubjectStoreActionData::createFromRequest($request));

            return to_route('subject.index')->with('message', trans('all.updated'));
        } catch (\Throwable $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        try {
            $this->service->delete($id);

            return back()->with('message', trans('form.deleted'));
        } catch (\Throwable $e) {
            return to_route('subject.index')->withErrors($th->getMessage());
        }
    }
}
