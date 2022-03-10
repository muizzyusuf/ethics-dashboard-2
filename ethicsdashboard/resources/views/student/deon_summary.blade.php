@extends('layouts.app')

@section('content')
 
<div>
    <a class="mb-2 btn btn-dark" href="{{route('casestudy.show', $casestudy->id)}}">
        ⏴Case Study
    </a> 
</div>

<div class="container mb-2">
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link" href="{{route('dashboard.show', $dashboard->id)}}">Summary</a>
        <a class="nav-link" href="{{route('ethicalissue.show', $ethicalissue->id)}}">Ethical Issue</a>
        <a class="nav-link" href="{{route('stakeholdersection.show', $dashboard->stakeholder_section_id)}}">Stakeholders</a>
        <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link active" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="container mb-2">
        <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
                <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Option Analysis</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Testing Categorical Imperatives</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('deontologysection.moralissue', $dashboard->deontology_section_id)}}">Moral Issue and Moral Laws</a>
                  <a class="dropdown-item" href="{{route('deontologysection.universalizability', $dashboard->deontology_section_id)}}" >Test the Universalizability and Consistency</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link active btn-dark" href="{{route('deontologysection.summary', $dashboard->deontology_section_id)}}">Summary</a>
            </li>
        </ul>
    </div>

    <div class="mb-2 alert alert-dark" role="alert">

        <h5 class="font-weight-bold">HYPOTHETICAL IMPERATIVES</h5>
        <hr>
        <ul class="list-unstyled">
            <li>A hypothetical imperative is a command in a conditional form </li>
            <ul>
                <li> E.g. If you want to do well on the midterm you must study!</li>
            </ul>
            <li>You study because you have a goal or a desire - to do well on the midterm. Hypothetical imperatives are commands that tell us what we should do, but they do not express moral laws.</p>
        </ul>

    </div>
    
    @for($i=0; $i<count($options); $i++)

        @if($options[$i]->imperative == 'hypothetical')

            <form>

                <div class="card border-secondary mt-2">
                    <div class="card-header font-weight-bold">

                        <div class="form-row">
                            <label for="option" class="col-form-label">Option:</label>
                            <div class="col">
                            <input type="text" name="option" class="form-control" id="option" value="{{$options[$i]->option}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <p class="card-subtitle mb-2">You selected the following reasons to support this option:</p>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Serves your interests" @if($options[$i]->motivations->contains('motivation','Serves your interests'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label" >
                            Serves your interests
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Serves the interests of someone else you want to impress" @if($options[$i]->motivations->contains('motivation','Serves the interests of someone else you want to impress'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label" >
                            Serves the interests of someone else you want to impress
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="It will look good" @if($options[$i]->motivations->contains('motivation','It will look good'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label" >
                            It will look good
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="It will pay off in the long run" @if($options[$i]->motivations->contains('motivation','It will pay off in the long run'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label" >
                            It will pay off in the long run
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Everybody wins" @if($options[$i]->motivations->contains('motivation','Everybody wins'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label">
                            Everybody wins
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="It costs very little" @if($options[$i]->motivations->contains('motivation','It costs very little'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label">
                            It costs very little
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Revenge" @if($options[$i]->motivations->contains('motivation','Revenge'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label">
                                Revenge
                            </label>
                        </div>

                        <div class="form-row">
                            <label class="col-form-label" for="other">Other:</label>
                            <input type="text" class="form-control col-3" name="other" @if($options[$i]->motivations->contains('other','Yes')) value="{{$options[$i]->motivations->firstWhere('other','Yes')->motivation}}" @endif readonly >
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="It's the right thing to do" @if($options[$i]->motivations->contains('motivation',"It's the right thing to do"))checked @endif name="motivations[]" disabled>
                            <label class="form-check-label">
                            It's the right thing to do
                            </label>
                        </div>
                        <p class="card-subtitle mt-2">These motivations are consistent with hypothetical reasoning and therefore cannot be a universal law of moral action</p>
                    
                    </div>

                </div>   
            </form>

        @endif
            
    @endfor

    <div class="my-2 alert alert-dark" role="alert">
        <h5 class="card-title font-weight-bold">CATEGORICAL IMPERATIVES</h5>
            <hr>

            <ul class="list-unstyled">
                <li>The fundamental principle of our moral duties is a categorical imperative</li>
                <ul>
                    <li> It is an imperative because it is a command addressed to agents who could follow it but might not</li>
                    <li> It is categorical in virtue of applying to us unconditionally - in all times and all places</li>
                </ul>
                <li>Unlike hypothetical imperatives, categorical imperatives are not relative to a desire or goal</li>
            </ul>
        

    </div>

    @for($i=0; $i<count($options); $i++)

        @if($options[$i]->imperative == 'categorical')

            <form>

                <div class="card border-secondary mt-2">
                    <div class="card-header font-weight-bold">

                        <div class="form-row">
                            <label for="option" class="col-form-label">Option:</label>
                            <div class="col">
                            <input type="text" name="option" class="form-control" id="option" value="{{$options[$i]->option}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <p class="card-subtitle mb-2 font-weight-bold">You selected the following reasons to support this option:</p>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Serves your interests" @if($options[$i]->motivations->contains('motivation','Serves your interests'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label" >
                            Serves your interests
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Serves the interests of someone else you want to impress" @if($options[$i]->motivations->contains('motivation','Serves the interests of someone else you want to impress'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label" >
                            Serves the interests of someone else you want to impress
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="It will look good" @if($options[$i]->motivations->contains('motivation','It will look good'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label" >
                            It will look good
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="It will pay off in the long run" @if($options[$i]->motivations->contains('motivation','It will pay off in the long run'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label" >
                            It will pay off in the long run
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Everybody wins" @if($options[$i]->motivations->contains('motivation','Everybody wins'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label">
                            Everybody wins
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="It costs very little" @if($options[$i]->motivations->contains('motivation','It costs very little'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label">
                            It costs very little
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Revenge" @if($options[$i]->motivations->contains('motivation','Revenge'))checked @endif name="motivations[]" disabled >
                            <label class="form-check-label">
                                Revenge
                            </label>
                        </div>

                        <div class="form-row">
                            <label class="col-form-label" for="other">Other:</label>
                            <input type="text" class="form-control col-3" name="other" @if($options[$i]->motivations->contains('other','Yes')) value="{{$options[$i]->motivations->firstWhere('other','Yes')->motivation}}" @endif readonly >
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="It's the right thing to do" @if($options[$i]->motivations->contains('motivation',"It's the right thing to do"))checked @endif name="motivations[]" disabled>
                            <label class="form-check-label">
                            It's the right thing to do
                            </label>
                        </div>
                        <p class="card-subtitle mt-2 font-weight-bold">These motivations are consistent with categorical reasoning because you selected "It's the right thing to do" and therefore may support a universal law of moral action; howerver, the law must be defined, univeral and consistent</p>
                        <div class="container border my-2 py-1 rounded">
                            <form>
                                <div class="form-group mt-2">
                                    <div class="form-row">
                                        <label for="morallaw" class="col-form-label">Moral Law:</label>
                                        <div class="col">
                                            <input type="text" name="morallaw" class="form-control" @if(isset($options[$i]->moralLaws[0])) value="{{$options[$i]->moralLaws[0]->moral_law}}" @endif  readonly >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label" for="">Universal - </label>
                                    <div class="form-check form-check-inline float-right">
                                        <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[0])) @if($options[$i]->moralLaws[0]->universalizability == 'no')checked @endif @endif value="no" disabled>
                                        <label class="form-check-label" for="universalizability">No</label>
                                    </div>
                                    <div class="form-check form-check-inline float-right">
                                        <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[0])) @if($options[$i]->moralLaws[0]->universalizability == 'yes')checked @endif @endif value="yes" disabled>
                                        <label class="form-check-label" for="universalizability">Yes</label>
                                    </div>  
                                </div>
            
                                <div class="form-group">
                                    <label class="" for="">Consistent - </label>
                                    <div class="form-check form-check-inline float-right">
                                        <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[0])) @if($options[$i]->moralLaws[0]->consistency == 'no')checked @endif @endif  value="no" disabled>
                                        <label class="form-check-label" for="consistency">No</label>
                                    </div>
                                    <div class="form-check form-check-inline float-right">
                                        <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[0])) @if($options[$i]->moralLaws[0]->consistency == 'yes')checked @endif @endif value="yes" disabled>
                                        <label class="form-check-label" for="consistency">Yes</label>
                                    </div>  
                                </div>
            
                            </form>
                        </div>
    
                        <div class="container border my-2 py-1 rounded">
                            <form>
                                <div class="form-group mt-2">
                                    <div class="form-row">
                                        <label for="morallaw" class="col-form-label">Moral Law:</label>
                                        <div class="col">
                                            <input type="text" name="morallaw" class="form-control" @if(isset($options[$i]->moralLaws[1])) value="{{$options[$i]->moralLaws[1]->moral_law}}" @endif  readonly >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label" for="">Universal - </label>
                                    <div class="form-check form-check-inline float-right">
                                        <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[1])) @if($options[$i]->moralLaws[1]->universalizability == 'no')checked @endif @endif value="no" disabled>
                                        <label class="form-check-label" for="universalizability">No</label>
                                    </div>
                                    <div class="form-check form-check-inline float-right">
                                        <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[1])) @if($options[$i]->moralLaws[1]->universalizability == 'yes')checked @endif @endif value="yes" disabled>
                                        <label class="form-check-label" for="universalizability">Yes</label>
                                    </div>  
                                </div>
            
                                <div class="form-group">
                                    <label class="" for="">Consistent - </label>
                                    <div class="form-check form-check-inline float-right">
                                        <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[1])) @if($options[$i]->moralLaws[1]->consistency == 'no')checked @endif @endif  value="no" disabled>
                                        <label class="form-check-label" for="consistency">No</label>
                                    </div>
                                    <div class="form-check form-check-inline float-right">
                                        <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[1])) @if($options[$i]->moralLaws[1]->consistency == 'yes')checked @endif @endif value="yes" disabled>
                                        <label class="form-check-label" for="consistency">Yes</label>
                                    </div>  
                                </div>
            
                            </form>
                        </div>
            
                        <div class="container border my-2 py-1 rounded">
                            
                            <div class="form-group mt-2">
                                <div class="form-row">
                                    <label for="morallaw" class="col-form-label">Moral Law:</label>
                                    <div class="col">
                                        <input type="text" name="morallaw" class="form-control" @if(isset($options[$i]->moralLaws[2])) value="{{$options[$i]->moralLaws[2]->moral_law}}" @endif  readonly >
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-form-label" for="">Universal - </label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->universalizability == 'no')checked @endif @endif value="no" disabled>
                                    <label class="form-check-label" for="universalizability">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->universalizability == 'yes')checked @endif @endif value="yes" disabled>
                                    <label class="form-check-label" for="universalizability">Yes</label>
                                </div>  
                            </div>
        
                            <div class="form-group">
                                <label class="" for="">Consistent - </label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->consistency == 'no')checked @endif @endif  value="no" disabled>
                                    <label class="form-check-label" for="consistency">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->consistency == 'yes')checked @endif @endif value="yes" disabled>
                                    <label class="form-check-label" for="consistency">Yes</label>
                                </div>  
                            </div>
            
                            
                        </div>
                    </div>

                    
                </div>   
            </form>
            

        @endif
            
    @endfor

    <div class="mt-3 card border-secondary">
        <p class="card-header font-weight-bold">ETHICAL DECISION/
            COURSE OF ACTION </p>
    
    
        <div class="card-body">
    
            <form method="POST" action="{{route('deontologysection.decision',$deontologySection->id)}}">
                {{ csrf_field() }}
                {{method_field('POST')}}
                <div class="form-group">
                    <label class="font-weight-bold" for="decision">Decision</label>
                    <textarea class="form-control" id="decision" name="decision" rows="3" placeholder="What option is the most morally correct one?">{{$deontologySection->decision}}</textarea>
                </div>
    
                <div class="form-group">
                    <input type="submit" class="float-right btn btn-primary" value="Save">
                </div>
            </form>
        </div>
       
        
    </div>

</div>



@endsection