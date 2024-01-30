<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQs - Your Website</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
  <style>
    .faq-container {
      max-width: 90%;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      text-align: left;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    .faq {
      margin-bottom: 20px;
    }

    .question {
  cursor: pointer;
  background-color: white;
  padding: 10px;
  margin-bottom: 5px;
  border: 1px solid rgb(243, 235, 235);
  border-radius: 5px;
  font-family: nunito;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Adjust the shadow color and size as needed */
}


    .answer {
      display: none;
      padding: 10px;
      background-color: white;
      border-radius: 5px;
    }
  </style>
</head>
<body>

  <div class="faq-container">
    <h1 style="margin-bottom:5px;font-family:nunito;font-size:30px">Frequently Asked Questions</h1>

    <div class="faq" onclick="toggleAnswer('faq1')">
      <div id="faq1" class="question"><p style="font-size:16px;font-weight:bold;">1. What is the reputation of the CoachingDetail?</p>
        <div class="answer"><p style="font-size:13px;margin-top:-8px;">The reputation of the CoachingDetail is excellent, with a top list of coaching courses for students in various competitive exams like Banking,Railway,SSC coaching institute and classes. We provide a conducive learning environment and education system. We believe in positive reviews and quality results.</p></div>
      </div>
    </div>

    <div class="faq" onclick="toggleAnswer('faq2')">
        <div id="faq2" class="question"><p style="font-size:16px;font-weight:bold;">2. What are the advantages of the CoachingDetail?</p>
          <div class="answer"><p style="font-size:13px;margin-top:-8px;">CoachingDetail provides a top coaching classes list with great features, easy to find your courses, comparing coaching institutes and including experienced tutors who serve you in-depth subject knowledge. </p></div>
        </div>
      </div>

      <div class="faq" onclick="toggleAnswer('faq3')">
        <div id="faq3" class="question"><p style="font-size:16px;font-weight:bold;">3. Why to choose CoachingDetail over other coaching listing sites?</p>
          <div class="answer"><p style="font-size:13px;margin-top:-8px;">CoachingDetail offers a more fascinating and interactive learning experience. We provide dynamic and real-time engagement with experienced tutors,coaching institutes and a structured curriculum. </p></div>
        </div>
      </div>

      <div class="faq" onclick="toggleAnswer('faq4')">
        <div id="faq4" class="question"><p style="font-size:16px;font-weight:bold;">4. Which coaching institute is best for NEET and JEE preparation?</p>
          <div class="answer"><p style="font-size:13px;margin-top:-8px;">Determining the best NEET and JEE coaching institute for exam preparation depends on various factors, including teaching styles,faculty expertise,success rate and location. Some well-known institutes that consistently perform well in our top coaching classes list.
        </p></div>
        </div>
      </div>

      <div class="faq" onclick="toggleAnswer('faq5')">
        <div id="faq5" class="question"><p style="font-size:16px;font-weight:bold;">5. What do I get on CoachingDetail?</p>
          <div class="answer"><p style="font-size:13px;margin-top:-8px;">In CoachingDetail, you gain access to expert guidance from experienced tutors who provide comprehensive coverage of the curriculum. Our coaching details list offers structured course details, and focused on top coachings,supportive teams,etc.</p></div>
        </div>
      </div>
      <div class="faq" onclick="toggleAnswer('faq6')">
        <div id="faq6" class="question"><p style="font-size:16px;font-weight:bold;">6. Why is CoachingDetail important for the students?</p>
          <div class="answer"><p style="font-size:13px;margin-top:-8px;">CoachingDetail plays a vital role for students as we offer specialized guidance, targeted exam preparation, structured learning system,and expert mentorship. Our list of coachings and courses provide a focused approach and contribution to crack exams for SSC, GATE, CMAT, BANK/IBPS,NEET/JEE and so on.</p></div>
        </div>
      </div>

      <div class="faq" onclick="toggleAnswer('faq7')">
        <div id="faq7" class="question"><p style="font-size:16px;font-weight:bold;">7. How do I choose the right coaching institute for my exam?</p>
          <div class="answer"><p style="font-size:13px;margin-top:-8px;">To choose the right NEET,JEE, BANK/IBPS.GATE,RAILWAY coaching institute for your exam, consider factors such as the coaching’s reputation, faculty expertise, success rates, and the relevance of study materials. </p></div>
        </div>
      </div>
      <div class="faq" onclick="toggleAnswer('faq8')">
        <div id="faq8" class="question"><p style="font-size:16px;font-weight:bold;">8. What support services do CoachingDetail offer, apart from regular classes?</p>
          <div class="answer"><p style="font-size:13px;margin-top:-8px;">CoachingDetail offers various services, apart from regular classes like correspondence classes, online classes. Tutors,Test Series and Library Services etc and we also add coaching institutes comparison options where you can search, compare and enroll easily.  </p></div>
        </div>
      </div>
      <div class="faq" onclick="toggleAnswer('faq9')">
        <div id="faq9" class="question"><p style="font-size:16px;font-weight:bold;">9. Which coaching classes are best for competitive exams?</p>
          <div class="answer"><p style="font-size:13px;margin-top:-8px;">We have a huge  list of the best competitive exam coaching classes such as RAILWAY,BANK/IBPS,SSC etc exams depending on various factors such as the specific exam, cities, and the reputation of the coaching institute. CoachingDetail serves you top well-known coaching institutes that have a strong track record in preparing students for competitive exams. </p></div>
        </div>
      </div>
      <div class="faq" onclick="toggleAnswer('faq10')">
        <div id="faq10" class="question"><p style="font-size:16px;font-weight:bold;">10. How can CoachingDetail help with exam-specific preparation?</p>
          <div class="answer"><p style="font-size:13px;margin-top:-8px;">We have an extensive list of coaching institutes which provide specially designed courses, conduct regular tests, and offer insights into the exact exam patterns for students. Our Expert tutor and faculty members guide students throughout the difficulties of the syllabus and focusing on key chapters.
          </p></div>
        </div>
      </div>





    <!-- Repeat the above structure for the remaining FAQs -->

  </div>

  <script>
    function toggleAnswer(faqId) {
      var faq = document.getElementById(faqId);
      var answer = faq.querySelector('.answer');
      if (answer.style.display === "none") {
        answer.style.display = "block";
      } else {
        answer.style.display = "none";
      }
    }
  </script>

</body>
</html>
