<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\OperationException;
use App\Services\SubjectService;
use App\Services\TopicService;
use App\ViewModels\TopicShowViewModel;
use Illuminate\View\View;

final class HomeController extends Controller
{

    public function __construct(
        protected SubjectService $service,
        protected TopicService $topicService
    ) {}

    public function home(): View
    {
        return view('home');
    }

    public function welcome(): View
    {
        $subjects = $this->service->paginate(limit: PHP_INT_MAX)->items;

        return view('welcome', compact('subjects'));
    }

    public function topicShow(int $id): View
    {
        try {
            $topicData = $this->topicService->getTopic($id);
            $viewModel = new TopicShowViewModel($topicData);

            return $viewModel->toView('topic.show');
        } catch (OperationException $e) {
            abort(404);
        }
    }
}
