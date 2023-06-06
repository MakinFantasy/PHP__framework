<?php
namespace Models\Comments;

use Models\Users\User;
use Models\ActiveRecordEntity;

class Comment extends ActiveRecordEntity
{
    protected $authorId;
    protected $articleId;
    protected $text;
    protected $createdAt;

    public function getAuthor(): User
    {
        return User::getbyId($this->authorId);
    }

    public function getCommentText()
    {
        return $this->text;
    }

    public function getTime()
    {
        return $this->createdAt;
    }

    public function setTime(string $time)
    {
        $this->createdAt = $time;
    }

    public function setCommentText(string $text)
    {
        $this->text = $text;
    }

    public function setAuthorId(int $authorId)
    {
        $this->authorId = $authorId;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function setArticleId(int $articleId)
    {
        $this->articleId = $articleId;
    }
    public static function getTableName(): string
    {
        return 'comments';
    }

}
?>