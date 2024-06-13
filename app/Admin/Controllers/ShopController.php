<?php

namespace App\Admin\Controllers;

use App\Models\Shop;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Shop';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Shop());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('openingtime', __('Openingtime'));
        $grid->column('closingtime', __('Closingtime'));
        $grid->column('price', __('Price'));
        $grid->column('address', __('Address'));
        $grid->column('phone', __('Phone'));
        $grid->column('closingday', __('Closingday'));
        $grid->column('image', __('Image'))->image();
        $grid->column('category.name', __('Category Name'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', '店名');
            $filter->like('description', '商品説明');
            $filter->between('price', '金額');
            $filter->in('category_id', 'カテゴリー')->multipleSelect(Category::all()->pluck('name', 'id'));
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Shop::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('openingtime', __('Openingtime'));
        $show->field('closingtime', __('Closingtime'));
        $show->field('price', __('Price'));
        $show->field('address', __('Address'));
        $show->field('phone', __('Phone'));
        $show->field('closingday', __('Closingday'));
        $show->field('image', __('Image'))->image();
        $show->field('category.name', __('Category Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Shop());

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->time('openingtime', __('Openingtime'))->default(date('H:i:s'));
        $form->time('closingtime', __('Closingtime'))->default(date('H:i:s'));
        $form->number('price', __('Price'));
        $form->textarea('address', __('Address'));
        $form->mobile('phone', __('Phone'));
        $form->textarea('closingday', __('Closingday'));
        $form->image('image', __('Image'));
        $form->number('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));

        return $form;
    }
}
