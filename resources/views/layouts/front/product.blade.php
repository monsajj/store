<div class="row">
    <div class="col-md-6">
        <ul id="thumbnails" class="col-md-4 list-unstyled">
            <li>
                <a href="javascript: void(0)">
                    @if ($product->images->count() > 0)
                        @foreach($product->images as $image)
                            @php
                                if ($loop->first)
                                    $cover = $image;
                            @endphp
                            <img class="img-responsive img-thumbnail"
                                 src="{{ asset("storage/$image->src") }}"
                                 alt="{{ $image->src }}"/>
                        @endforeach
                    @else
                        <img class="img-responsive img-thumbnail"
                             src="{{ asset("https://placehold.it/180x180") }}"
                             alt="{{ $product->name }}"/>
                    @endif
                </a>
            </li>
            @if(isset($images) && !$images->isEmpty())
                @foreach($images as $image)
                    <li>
                        <a href="javascript: void(0)">
                            <img class="img-responsive img-thumbnail"
                                 src="{{ asset("storage/$image->src") }}"
                                 alt="{{ $product->name }}"/>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
        <figure class="text-center product-cover-wrap col-md-8">
            @if(isset($cover))
                <img id="main-image" class="product-cover img-responsive"
                     src="{{ asset("storage/$cover->src") }}?w=400"
                     data-zoom="{{ asset("storage/$cover->src") }}?w=1200">
            @else
                <img id="main-image" class="product-cover" src="https://placehold.it/300x300"
                     data-zoom="{{ asset("storage/$product->cover") }}?w=1200" alt="{{ $product->name }}">
            @endif
        </figure>
    </div>
    <div class="col-md-6">
        <div class="product-description">
            <h1>{{ $product->name }}
                <small>{{ config('cart.currency') }} {{ $product->formatted_price }}</small>
            </h1>
            <div class="description">{!! $product->description !!}</div>
            <div class="excerpt">
                <hr>{!!  str_limit($product->description, 100, ' ...') !!}</div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.errors-and-messages')
                    <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                        @csrf
                        @if(isset($productAttributes) && !$productAttributes->isEmpty())
                            <div class="form-group">
                                <label for="productAttribute">Choose Combination</label> <br/>
                                <select name="productAttribute" id="productAttribute" class="form-control select2">
                                    @foreach($productAttributes as $productAttribute)
                                        <option value="{{ $productAttribute->id }}">
                                            @foreach($productAttribute->attributesValues as $value)
                                                {{ $value->attribute->name }} : {{ ucwords($value->value) }}
                                            @endforeach
                                            @if(!is_null($productAttribute->price))
                                                ( {{ config('cart.currency_symbol') }} {{ $productAttribute->price }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                        @endif
                        <div class="form-group">
                            <input type="text"
                                   class="form-control"
                                   name="quantity"
                                   id="quantity"
                                   placeholder="Quantity"
                                   value="{{ old('quantity') }}"/>
                            <input type="hidden" name="product" value="{{ $product->id }}"/>
                        </div>
                        <button type="submit" class="btn btn-warning"><i class="fa fa-cart-plus"></i> Add to cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(isset($comments))
    <div>
        <div class="row">
            <div class="col-md-12">
                <h1>
                    Комментарии
                </h1>
                @if($comments->count() == 0)
                    <p>
                        Тут пока нет ни одного комментария ...
                    </p>
                @endif
                <div class="product-description">
                    @foreach($comments as $comment)
                        <h3>
                            @if($comment->email !== null)
                                <a href="mailto:{{ ucwords($comment->email) }}">{{ ucwords($comment->user_name) }}</a></p>

                            @else
                                {{ ucwords($comment->user_name) }}
                            @endif
                            <small>{{ $comment->email }}</small>
                        </h3>
                        <div class="description">{!! $comment->text !!}</div>
                        <div class="excerpt">
                            <hr>{!!  str_limit($comment->text, 100, ' ...') !!}</div>
                        <hr>
                    @endforeach
                </div>
            </div>

            <div class="col-md-12">
                <h1>
                    Добавить Комментарий
                </h1>

                @include('layouts.errors-and-messages')
                <form action="{{ route('comment.store') }}" class="form-inline" method="post">
                    @csrf
                    <div class="form-group">
                        @unless(Auth::check())
                        <input type="text"
                               class="form-control"
                               name="user_name"
                               id="user_name"
                               placeholder="Your Name"/>
                        <input type="text"
                               class="form-control"
                               name="email"
                               id="email"
                               placeholder="Your Email"/>
                        @else
                            <input type="hidden" name="user_name" value="{{ Auth::user()->name }}"/>
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}"/>
                        @endunless
                        <input type="text"
                               class="form-control"
                               name="text"
                               id="text"
                               placeholder="Your Comment"/>
                        <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                        <input type="hidden" name="product_slug" value="{{ $product->slug }}"/>
                    </div>
                    <button type="submit" class="btn btn-warning"><i class="fa fa-cart-plus"></i> Add comment
                    </button>
                </form>
            </div>
        </div>


    </div>
@endif


@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var productPane = document.querySelector('.product-cover');
            var paneContainer = document.querySelector('.product-cover-wrap');

            new Drift(productPane, {
                paneContainer: paneContainer,
                inlinePane: false
            });
        });
    </script>
@endsection
