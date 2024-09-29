<?php

namespace App\Livewire\Frontend;

use App\Models\Comments as ModelsComments;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Comments extends Component
{
    public $rating = 5, $name, $comment, $email, $number, $id, $commentSubmitted = false;

    public function rules()
    {
        return [
            'id'        => 'required',
            'rating'    => 'required',
            'comment'   => 'required',
            'name'      => 'required',
            'email'     => 'required|email',
            'number'    => 'required|min:11',
        ];
    }

    public function save()
    {
        $this->validate();

        // Check if the user has already submitted a comment
        if ($this->hasSubmittedComment()) {
            $this->commentSubmitted = true;
            Session::flash('err', 'You can not comment multiple time');
        } else {

            $comment = new ModelsComments();
            $comment->product_id    = $this->id;
            $comment->name          = $this->name;
            $comment->email         = $this->email;
            $comment->number        = $this->number;
            $comment->rating        = $this->rating;
            $comment->comment       = $this->comment;
            $comment->save();

            Session::flash('succ', 'Thank you for your rating');

            Cookie::queue(Cookie::make('comment_submitted', true, 10));
        }
    }

    private function hasSubmittedComment()
    {
        // Check if the cookie exists indicating that the user has already submitted a comment
        return Cookie::has('comment_submitted');
    }

    public function render()
    {

        $orderReview = Cookie::has('order');

        return view('livewire.frontend.comments', [
            'order'   => $orderReview
        ]);
    }
}
