<?php

namespace App\Http\Controllers;

use App\Http\Models\Review\ReviewRepository;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * @var ReviewRepository
     */
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->middleware(['auth', 'check.admin' ]);
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $reviews = $this->reviewRepository->getWithPagination();

        return view('reviews.index', [
            'reviews' => $reviews,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(int $id)
    {
        $this->reviewRepository->delete((int) $id);
    }
}
