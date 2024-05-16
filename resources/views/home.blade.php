<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment | Home</title>

    <link rel="icon" type="image/x-icon" href="{{url("assets/image/bsb-logo.jpg")}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <header class="p-3 mb-3 border-bottom">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
              <img src="{{url("assets/image/bsb-logo.jpg")}}" class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"/>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="{{route('home')}}" class="nav-link px-2 link-secondary">Home</a></li>
            </ul>

            <div class="dropdown text-end">
              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                 {{auth()->user()->name}}
              </a>
              <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">

                <li><a class="dropdown-item" href="{{route('logout')}}">Sign out</a></li>
              </ul>
            </div>
          </div>
        </div>
    </header>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1>Multiple Choice Questions</h1>

                    @if(session('message'))
                        <p>{{ session('message') }}</p>
                    @endif

                    <form action="{{ route('quiz') }}" method="POST">
                        @csrf
                        @foreach($questions as $index => $question)
                            <fieldset class="mb-3">
                                <legend>{{ $question['question'] }}</legend>
                                <div class="d-flex justify-content-between">
                                    @foreach($question['options'] as $option)
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="answers[{{ $index }}][]" value="{{ $option }}">
                                            {{ $option }}
                                        </label><br>
                                    @endforeach
                                </div>
                            </fieldset>
                            <input type="hidden" name="questions[{{ $index }}][question]" value="{{ $question['question'] }}">
                            <input type="hidden" name="questions[{{ $index }}][answer][]" value="{{ implode(',', $question['answer']) }}">
                        @endforeach
                        <button type="submit" class="btn btn-primary">Submit Answers</button>
                    </form>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
