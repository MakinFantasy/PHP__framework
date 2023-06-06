<?php
namespace Controllers;

use Models\Comments\Comment;
use Models\Articles\Article;
use Models\Users\User;
use View\View;
use Services\Db;

class CommentController
{
    private $view;
    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
        $this->db = Db::getInstance();
    }

    public function show(int $id)
    {
        $comment = Comment::getById($id);

        if (!$comment) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
        $this->view->renderHtml('comments/show.php', ['comment' => $comment]);
    }

    public function store()
    {
        $comment = new Comment;
        $comment->setCommentText($_POST['text']);
        $comment->setAuthorId($_POST['authorId']);
        var_dump($_POST['articleId']);
        echo '<br>';
        $comment->setArticleId($_POST['articleId']);
        var_dump($_POST['text']);
        $res = $comment->save();
    }

    public function edit(int $id)
    {
        $users = User::findAll();
        $comment = Comment::getById($id);
        $this->view->renderHtml('comments/edit.php', ['comment' => $comment, 'users' => $users]);
    }
    public function update(int $id)
    {
        var_dump($_POST['text']);

        $comment = Comment::getById($id);
        $comment->setTime($_POST['time']);
        $comment->setCommentText($_POST['text']);
        $comment->setAuthorId($_POST['authorId']);
        var_dump($comment);
        $comment->save();
        $this->show($id);
    }

    public function delete(int $id)
    {
        $comment = Comment::getById($id);
        var_dump($comment);
        $comment->destroy();
        $comment->id = 0;
    }
}
?>