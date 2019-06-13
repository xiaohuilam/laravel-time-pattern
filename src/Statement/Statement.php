<?php
namespace Xiaohuilam\LaravelTimePattern\Statement;

use Illuminate\Pipeline\Pipeline;
use Xiaohuilam\LaravelTimePattern\Date\Carbon;
use Xiaohuilam\LaravelTimePattern\Pattern;
use Xiaohuilam\LaravelTimePattern\Result\ResultObject;

/**
 * 分词分出的单元
 */
class Statement
{
    /**
     * @var string[]|array
     */
    protected $statement;

    public function __construct($statement)
    {
        $this->statement = collect($statement)->only('word', 'tag')->toArray();
    }

    public function __toString()
    {
        return $this->statement;
    }

    /**
     * 尝试解析时间
     */
    public function parse($parameters, $next)
    {
        /**
         * @var Carbon $from
         * @var Carbon $to
         * @var array $ret
         * @var ResultObject[] $stack
         */
        list(&$from, &$to, &$ret, &$stack) = $parameters;

        if ($this->statement['tag'] == 't') {
            /**
             * @var ResultObject[] $results
             */
            $results = [];
            Pattern::try($this->statement['word'], $from, $to, $results, $stack);

            $ret[] = [
                'statement' => $this->statement['word'],
                'tag' => $this->statement['tag'],
                'results' => $results,
            ];

            $stack = array_merge($stack, $results);
        } else {
            $ret[] = [
                'statement' => $this->statement['word'],
                'tag' => $this->statement['tag'],
                'results' => [],
            ];
        }

        return $next($parameters);
    }
}
