<?php
/**
 * Task controller.
 */

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TaskController.
 */
#[Route('/book')]
class BookController extends AbstractController
{
    /**
     * Index action.
     *
     * @param BookRepository $bookRepository Book repository
     *
     * @return Response HTTP response
     */
    #[Route(
        name: 'book_index',
        methods: 'GET'
    )]

    /**
     * Index action.
     *
     * @param Request            $request        HTTP Request
     * @param BookRepository     $bookRepository Task repository
     * @param PaginatorInterface $paginator      Paginator
     *
     * @return Response HTTP response
     */

    public function index(Request $request, BookRepository $bookRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $bookRepository->queryAll(),
            $request->query->getInt('page', 1),
            BookRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render('book/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Book $book Book entity
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'book_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET',
    )]
    public function show(Book $book): Response
    {
        return $this->render(
            'book/show.html.twig',
            ['book' => $book]
        );
    }
}