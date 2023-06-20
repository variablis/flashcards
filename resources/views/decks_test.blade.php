<x-app-layout>

    <div class="max-w-xl mx-auto p-4 sm:p-6 lg:p-8">

        <div id="card-block" class="bg-white shadow overflow-hidden sm:rounded-md max-w-lg mx-auto p-6">
            <div id="card">
                <div id="q" class="p-6"></div>
                <hr>
                <div id="a" class="p-6"></div>
            </div>
            
            <div id="answer-block" style="display: none;">
                <a id="btn-show" href="#card" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4" >Show Answer</a>
            </div>
            
            <div id="next-block" style="display: none;">
                <x-my-link id="btn-wrong" color="rose" href="#card">Wrong</x-my-link>
                <x-my-link id="btn-correct" color="emerald" href="#card">Correct</x-my-link>
            </div>
        </div>
    
        <div id="end-block" class="bg-white shadow overflow-hidden sm:rounded-md max-w-sm mx-auto p-6" style="display: none;">
            All flashcards reviewed. 
            {{-- <a href="{{ route('decks.index') }}">Back to decks</a> --}}
            <x-my-link href="{{ route('decks.index') }}">Back to decks</x-my-link>
        </div>
    </div>


    <script>
        var mydata = @json($xdata);
        var currentIndex = 0;
        var qElement = document.getElementById('q');
        var aElement = document.getElementById('a');
        var showBtnElement = document.getElementById('btn-show');
        var answerBlockElement = document.getElementById('answer-block');
        var nextBlockElement = document.getElementById('next-block');
        var wrongBtnElement = document.getElementById('btn-wrong');
        var correctBtnElement = document.getElementById('btn-correct');
        var endBlockElement = document.getElementById('end-block');
        var cardBlockElement = document.getElementById('card-block');

        var tnow = new Date();
        var fdata = mydata.filter(function(el) {
            var t1=new Date(el.last_viewed);
            var diff = ( Math.ceil((tnow-t1)/ (1000 * 3600 * 24) ) );
            return diff > 3 || el.last_answer==0;
        });

        // console.log(fdata);

    
        function showAnswer() {
            if (aElement && answerBlockElement && nextBlockElement) {
                aElement.style.display = 'block';
                answerBlockElement.style.display = 'none';
                nextBlockElement.style.display = 'block';
            }
        }
    
        function nextCard(val, cardid) {

            var tw = fdata[currentIndex].times_viewed;
            var ta = fdata[currentIndex].times_answered;

            tw++;
            
            if(val==1){
                ta++;
            }

            var id = cardid;
            var url = "{{ route('flashcard.update', ':id') }}";
            url = url.replace(':id', id);
            var token = "{{ $token = csrf_token(); }}";

            fetch(url, {
                method: "put",
                headers: {
                    "Content-type": "application/json; charset=UTF-8",
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    r_times_viewed: tw,
                    r_times_answered: ta,
                    r_last_answer: val,
                }),
            });

            
            currentIndex++;
            if (currentIndex < fdata.length) {
                populateCard(currentIndex);
            } else {
                showEndBlock();
            }
        }

        function showEndBlock() {
            if (endBlockElement) {
                endBlockElement.style.display = 'block';
                cardBlockElement.style.display = 'none';
            }
        }

        function showCardBlock() {
            if (cardBlockElement) {
                endBlockElement.style.display = 'none';
                cardBlockElement.style.display = 'block';
            }
        }
    
        function populateCard(idx) {
            if (fdata.length && qElement && aElement && showBtnElement && answerBlockElement && nextBlockElement) {
                qElement.textContent = fdata[idx].question;
                aElement.textContent = fdata[idx].answer;
                aElement.style.display = 'none';
                showBtnElement.style.display = 'block';
                answerBlockElement.style.display = 'block';
                nextBlockElement.style.display = 'none';
                wrongBtnElement.href = '#card';
                wrongBtnElement.onclick = function() { nextCard(0, fdata[idx].id); };
                correctBtnElement.href = '#card';
                correctBtnElement.onclick = function() { nextCard(1, fdata[idx].id); };
                showBtnElement.onclick = function() { showAnswer(); };
            }
        }
    
        document.addEventListener('DOMContentLoaded', function() {
            populateCard(currentIndex);

            if(fdata.length==0){
                showEndBlock();
            }else{
                showCardBlock();
            }
        });
        
    </script>
  

</x-app-layout>
