<?php

namespace Illuminate\Pagination;

use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;
use Illuminate\Support\HtmlString;

class SimpleBootstrapFourPresenter extends BootstrapFourPresenter
{
    /**
     * Create a simple Bootstrap 4 presenter.
     *
     * @param  \Illuminate\Contracts\Pagination\Paginator  $paginator
     * @return void
     */
    public function __construct(PaginatorContract $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Convert the URL window into Bootstrap HTML.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function render()
    {
        if ($this->hasPages()) {
            return new HtmlString(sprintf(
                '<ul class="pager">%s %s</ul>',
                $this->getPreviousButton(),
                $this->getNextButton()
            ));
        }

        return '';
    }

    /**
     * Determine if the underlying paginator being presented has pages to show.
     *
     * @return bool
     */
    public function hasPages()
    {
        return $this->paginator->hasPages() && count($this->paginator->items()) > 0;
    }
}
