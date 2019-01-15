<?php


namespace App\Http\Models\Review;


use App\Http\Frontend\Reviews\ReviewPagination;

class ReviewRepository
{
    /**
     * @return Review[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getWithPagination()
    {
        return Review::paginate(ReviewPagination::$maxItemsOnPage);
    }

    /**
     * @param Review $review
     * @return bool
     */
    public function save(Review $review): bool
    {
        return $review->save();
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        return Review::destroy($id);
    }
}