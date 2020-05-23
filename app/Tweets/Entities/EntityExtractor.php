<?php


namespace App\Tweets\Entities;


class EntityExtractor
{

    /**
     *
     */
    const HASHTAG_REGEX = '/(?!\s)#([a-zA-Z0-9ぁ-んァ-ヶー一-龠０-９]\w*)\b/u';

    /**
     * @var
     */
    protected $string;

    /**
     * EntityExtractor constructor.
     * @param $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * @return array|array[]
     */
    public function getHashtagEntities(): array
    {
        return $this->buildEntityArray(
            $this->match(self::HASHTAG_REGEX),
            EntityType::HASHTAG
        );
    }

    /**
     * @param $entities
     * @param $type
     * @return array[]
     */
    protected function buildEntityArray($entities, $type): array
    {
        return array_map(function ($entity, $index) use ($entities, $type) {
            return [
                'body' => $entity[0],
                'body_plain' => $entities[1][$index][0],
                'start' => $start = $entity[1],
                'end' => $start + mb_strlen($entity[0]),
                'type' => $type
            ];
        }, $entities[0], array_keys($entities[0]));
    }

    /**
     * @param $pattern
     * @return mixed
     */
    protected function match($pattern)
    {
        preg_match_all(
            $pattern,
            $this->string,
            $matches,
            PREG_OFFSET_CAPTURE
        );

        return $matches;
    }

}
