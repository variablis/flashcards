<x-app-layout>

    <div class="pt-24">
    <div class="mx-auto md:w-1/2 min-h-full bg-white p-8 rounded-lg shadow-lg">

    {{-- <div class="max-w-xl mx-auto p-4 sm:p-6 lg:p-8"> --}}

        <div id="card-block">
            <div id="card">
                <div id="q" class="p-6"></div>
                <hr>
                <div id="a" class="p-6 mb-4"></div>
            </div>
            
            <div id="answer-block" class="flex justify-center hidden mt-6">
                <button id="btn-show" type="button" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">{{__('Show answer')}}</button>
            </div>
            
            <div id="next-block" class="flex justify-center hidden" >
                <button id="btn-wrong" type="button" class="text-red-500 hover:text-white border border-red-500 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">{{__('Wrong')}}</button>

                <button id="btn-correct" type="button" class="text-green-500 hover:text-white border border-green-500 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">{{__('Correct')}}</button>
            </div>
        </div>
    
        <div id="end-block" style="hidden">
            <p class="pb-6 text-center">{{__('All flashcards reviewed.')}}</p>
            <div class="flex justify-center">
            <x-my-link href="{{ route('decks.index') }}">{{__('Back to decks')}}</x-my-link>
            </div>
        </div>

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
                nextBlockElement.style.display = 'flex';
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
            const token = document.querySelector('meta[name="csrf-token"]').content;

            fetch(url, {
                method: "put",
                headers: {
                    "Content-type": "application/json; charset=UTF-8",
                    'X-Requested-With': 'XMLHttpRequest',
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
                showBtnElement.style.display = 'flex';
                answerBlockElement.style.display = 'flex';
                nextBlockElement.style.display = 'none';
                wrongBtnElement.href = '#';
                wrongBtnElement.onclick = function() { nextCard(0, fdata[idx].id); };
                correctBtnElement.href = '#';
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
