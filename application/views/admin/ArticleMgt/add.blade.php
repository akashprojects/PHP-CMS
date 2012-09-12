@layout('admin.template')
@section('title')
Add/Edit articles
@endsection

@section('content')


<!-- Include javascript files   -->
@section('headerfiles')
<?php echo Asset::scripts(); ?>
@endsection

<?php echo Asset::styles(); ?>
<?php

echo render('admin.navigation', array('type' => 'Articles', 'mode' => 'Add'));
?>



<div id="admincontent">


    <h2><?php echo $message; ?></h2>

    <div class="shadowed">
        <div class="inner-boundary">
            <div class="inner-border" style="padding: 10px;">
                <div id="errorcolor">
                    @foreach ($errors->all('<div id="notificationtext">:message</div>') as $errors)
                    {{  $errors }}
                    @endforeach
                    @if (Session::has('errormessage'))
                    <div id="notificationtext"> {{ Session::get('errormessage') }}  </div>
                    @endif
                </div>
                <div id="successcolor">

                    @if (Session::has('successmessage'))
                    <div id="notificationtext">  {{ Session::get('successmessage') }}  </div>
                    @endif
                </div>
                <?php echo Form::open('admin/articles/add'); ?>

                <!-- hidden fields for Article editing more and Auto selecting category -->
                <?php echo Form::hidden('ArticleEditing', Input::old('ArticleEditing', $passedArticle->id)); ?>
                <?php echo Form::hidden('ArticleCategoryAutoSelect', Input::old('ArticleCategoryAutoSelect', $passedArticle->category_id)); ?>

                <div style="padding: 5px;">

                    <div>
                        <div style="float:left">
                            <label style="font-weight: bold;display:block;">Title:</label>

                            <p id="message" style="display:inline;">Article Ttitle, describes the heading</p>
                        </div>
                        <div style="float:right">
                            <?php if (!is_null($passedArticle->getArticleUrl())) echo '<a style="float: right;" id="adminbutton" target="_blank" href="' . $passedArticle->getArticleUrl() . '">Click to view</a>';?>
                        </div>
                    </div>
                    <?php echo Form::text('ArticleTitle', Input::old('ArticleTitle', $passedArticle->title), array("style" => "margin-left: 0px;", "id" => "ArticleTitle", "autocomplete" => "false", "onkeyup" => "createUrl(this,1,0)")); ?>
                    <br>

                    <br>
                    <label style="font-weight: bold;display:block;">Url:</label>

                    <p id="message">A unique address of the page for your visitors</p>
                    <label id="ArticleUrl"
                           style="margin-left: 0px;">http://localhost/</label><?php echo Form::text('ArticleTitleUrl', Input::old('ArticleTitleUrl', $passedArticle->url), array("style" => "margin-left: 0px;width: 784px;margin-right: 0px;border: none", "autocomplete" => "off", "id" => "ArticleTitleUrl", 'onkeyup' => 'createUrl(this,2,1)')); ?>


                    <!-- task body -->
                    <br>
                    <br>
                    <label style="font-weight: bold;display:block;">Content:</label>

                    <p id="message">Start typing below</p>
                    <?php echo Form::textarea('ArticleContent', Input::old('ArticleContent', $passedArticle->content), array("id" => "textareabox")); ?>
                    <br>

                    <label style="font-weight: bold;display:block;">Tags:</label>

                    <p id="message" style="margin-bottom: 4px;">Add one or more tags for SEO</p>
                    <?php echo cmsHelper::getTagSelectBox(Session::has('EditedTags') ? Session::get('EditedTags') : $passedArticle->getTagItems());?>


                    <br><br>
                    <label style="font-weight: bold;display:block;">Final Settings:</label>

                    <p id="message" style="margin-bottom: 4px;">Adjust final settings before publishing</p>


                    <div id="articlesettings">
                        <table>
                            <tr>
                                <td><p>Post Status </p></td>
                                <td><?php echo Form::select('StatusSelect', cmsHelper::getArticleStatusArray(), Input::old('StatusSelect', $passedArticle->status)); ?></td>
                                <td><p>Only Title </p></td>
                                <td><?php echo Form::select('OnlyTitleSelect', cmsHelper::getDisableEnableArray(), Input::old('OnlyTitleSelect', $passedArticle->onlytitle)); ?></td>
                                <td><p>Type </p></td>
                                <td><?php echo Form::select('ArticleType', cmsHelper::getArticleTypeArray(), Input::old('ArticleType', $passedArticle->articletype)); ?></td>
                                <td><p>Author </p></td>
                                <td><?php echo Form::select('Author', cmsHelper::getAllAuthorsArray(), Input::old('Author', $passedArticle->author_id - 1), Auth::user()->id != 1 ? array("disabled" => "enabled") : array()); ?></td>
                                <td><p>Comments </p></td>
                                <td><?php echo Form::select('Comments', array("No","Yes"), Input::old('Comments', $passedArticle->comments )); ?></td>

                                <td><?php echo Form::submit('Submit', array('id' => 'adminbutton')); ?></td>
                            </tr>
                        </table>

                    </div>
                    <br>

                    <label style="font-weight: bold;display:block;">Select Category</label>

                    <p id="message" style="margin-bottom: 4px;">Select article category</p>

                    <?php $tempv = Input::old('ArticleEditing', $passedArticle->id); ?>

                    <div id="Categories">
                        @foreach (Category::all() as $category)
                        @if ($category->parent_id == null )
                        <div id="CategoryBlock">
                            <ul>
                                <li title="{{$category->curl}}"><label>
                                    {{ Form::radio('ArticleCategory', $category->id, false, array('onclick' =>'adjustCategoryUrl(this)') ) }}
                                    {{ $category->cname }}
                                </label>
                                    <ul>
                                        @foreach ($category->InnerCategory()->get() as $innerCategory)
                                        <li title="{{$innerCategory->curl}}"><label>
                                            {{ Form::radio('ArticleCategoryInner', $innerCategory->id, false,array('onclick' => 'adjustCategoryUrl(this)') ) }}
                                            {{ $innerCategory->cname }}
                                        </label></li>
                                        @endforeach
                                    </ul>
                                </li>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                </form>
            </div>
            <script>
                //Lets auto select the User Category
                $(document).ready(function () {
                    findCategoryELementById(document.forms[0]["ArticleCategoryAutoSelect"].value);
                    $('.chzn-select').chosen();
                    $('#successcolor').fadeIn(800);
                    $('#errorcolor').fadeIn(800);
                });

                CKEDITOR.replace('textareabox',{ toolbar:'MyToolbar'} );

            </script>

            @endsection
