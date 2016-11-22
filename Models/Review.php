<?php

class Review{
	private $_review;
	private $_reviewDate;
	private $_reviewer;
	private $_reviewed;

	public function __construct($review, $dateTime, $reviewer, $reviewed)
	{
		$this->_review = $review;
		$this->_reviewDate = $dateTime;
		$this->_reviewer = $reviewer;
		$this->_reviewed = $reviewed;
	}
	public function getReview()
	{
		return $this->_review;
	}
	public function getReviewDate()
	{
		return $this->_reviewDate;
	}
	public function getReviewer()
	{
		return $this->_reviewer;
	}
	public function getReviewed()
	{
		return $this->_reviewed;
	}
	public function setReview($review)
	{
		$this->review = $review;
	}
}
