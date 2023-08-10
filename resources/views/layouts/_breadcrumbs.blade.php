<section for="breadcrumbs" th:fragment="breadcrumbs" id="breadcrumb">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>

                @if(isset($breadcrumbs))
                    @foreach ($breadcrumbs as $crumb)
                    <li class="breadcrumb-item active" aria-current="page">
                    @if ($crumb['active'])
                        <a href="{{ $crumb['url'] }}">{{$crumb['label']}}</a>
                    @else
                        <span>{{$crumb['label']}}</span>
                    @endif
                    </li>
                    @endforeach
                @endif
            </ol>
    </nav>
    <hr style="margin: -13px -20px 25px -25px !important; color: lightgray;"/>	
</section>