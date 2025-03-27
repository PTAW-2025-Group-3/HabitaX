<section class="max-w-5xl mx-auto mt-20 mb-24 px-4">
  <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-2">FAQ’s</h2>
  <p class="text-center text-sm text-gray-500 mb-10">The Most Frequently Asked Questions</p>

  <div class="bg-gray-50 rounded-2xl shadow-xl divide-y divide-gray-200">

    @php
      $faqs = [
        ['question' => '01. How to create an ad?', 'answer' => 'Fill out the form with the required details and click on "Publish Ad". Your property will be listed immediately.'],
        ['question' => '02. How to edit or delete an ad?', 'answer' => 'Go to your dashboard, select the ad you want to edit or delete, and use the respective button.'],
        ['question' => '03. How to schedule visits?', 'answer' => 'Use the contact form or phone number provided in the ad to arrange a visit directly with the owner.'],
        ['question' => '04. How to report a problem with a property?', 'answer' => 'Contact our support team using the contact form above or email us directly at support@habitax.pt.']
      ];
    @endphp

    @foreach ($faqs as $index => $faq)
      <div class="p-6 transition-all hover:bg-gray-100 group">
        <div class="flex justify-between items-start cursor-pointer" onclick="toggleFaq({{ $index }})">
          <div class="flex items-center space-x-3">
            <span class="text-xl font-extrabold text-gray-800">{{ $index + 1 < 10 ? '0' . ($index + 1) : $index + 1 }}</span>
            <h3 class="text-indigo-700 font-bold text-lg">{{ $faq['question'] }}</h3>
          </div>
          <button class="text-indigo-600 text-2xl font-bold focus:outline-none transition-transform duration-300 transform" id="toggle-icon-{{ $index }}">+</button>
        </div>
        <div class="mt-4 pl-11 text-sm text-gray-700 hidden transition-all duration-300 ease-in-out" id="faq-answer-{{ $index }}">
          {{ $faq['answer'] }}
        </div>
      </div>
    @endforeach

  </div>
</section>

<script>
  function toggleFaq(index) {
    const answer = document.getElementById(`faq-answer-${index}`);
    const icon = document.getElementById(`toggle-icon-${index}`);

    const isOpen = !answer.classList.contains('hidden');

    // Hide all others
    document.querySelectorAll('[id^="faq-answer-"]').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('[id^="toggle-icon-"]').forEach(el => el.innerText = '+');

    if (!isOpen) {
      answer.classList.remove('hidden');
      icon.innerText = '×';
    }
  }
</script>
