
<?php
class Post
{
    public $id;
    public $title;
    public $content;

    function __construct($id, $title, $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    static function all()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM posts');

        foreach ($req->fetchAll() as $item) {
            $list[] = new Post($item['id'], $item['title'], $item['content']);
        }

        return $list;
    }
}