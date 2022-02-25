<?php

declare(strict_types=1);

class CommentTreeGenerator
{
    /**
     * @param array $comments
     * @return array
     */
    public function createTree(array $comments): array
    {
        $res = [];
        foreach ($comments as &$item) {
            if ($item[1] !== $item[0]) {
                $comments[$item[1] - 1][] =& $item;
            }
        }
        unset($item);

        foreach ($comments as $item) {
            if ($item[1] === $item[0]) {
                $res[] = $item;
            }
        }

        return $res;
    }

    /**
     * @param array $commentsTree
     */
    public function renderTree(array $commentsTree): void
    {
        foreach($commentsTree as $comment) {
            if (is_string($comment)) echo '<li>'.$comment.'</li>';

            if (is_array($comment)) {
                echo '<ul>';
                $this->renderTree($comment);
                echo '</ul>';
            }
        }
    }
}

$comments = [
    [1, 1, 'Comment 1'],
    [2, 1, 'Comment 2'],
    [3, 2, 'Comment 3'],
    [4, 1, 'Comment 4'],
    [5, 2, 'Comment 5'],
    [6, 3, 'Comment 6'],
    [7, 7, 'Comment 7']
];

$generator = new CommentTreeGenerator();
$tree = $generator->createTree($comments);
$generator->renderTree($tree);