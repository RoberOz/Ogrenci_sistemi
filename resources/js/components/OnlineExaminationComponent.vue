<template>
  <div>
    <div class="card-header" style="background:#DFDFDF">
      <div align="center">
        {{hours}}:{{minutes}}:{{seconds}}
      </div>
    </div>
    <form v-on:submit.prevent="submitForm">
      <div v-if="questions[0].content">
        <div class="card-header" style="background:#DFDFDF">
          <div class="btn-group" v-for="(question,index) in questions">
            <button type="button" class="btn btn-primary btn-outline-light" style="background:#539E5D;" @click="pickQuestion(index)" :disabled="clicked.includes(index)">{{index + 1}}</button>
          </div>
        </div><br>
        <table>
          <tr>
            <td>
              {{questions[questionIndex].order}})
              {{questions[questionIndex].content}}<br>
            </td>
          </tr>
          <tr>
            <td>
              <div v-for="option in questions[questionIndex].options">
                <input type="radio" name="question_answer" @change="pickAnswer" v-model="answer" :value="option['key']">
                {{option['key']}}) {{option['value']}}
                <br>
              </div>
              <br>
              <button type="button" class="btn btn-primary btn-outline-light btn-sm" @click="answer = null">Seçenekleri temizle</button>
              <br><br>
              <div class="btn-group">
                <button type="button" class="btn btn-primary btn-outline-light" style="background:#2AC020" @click="saveAnswer(questionIndex)">Cevabı Kaydet</button>
                <button type="submit" class="btn btn-primary btn-outline-light">Sınavı bitir ve Gönder</button>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import Swal from 'sweetalert2';
Vue.prototype.$eventBus = new Vue();

  export default {
    props: [
      'examination',
      'user'
    ],
    data() {
      return {
        exam_start_time: "",
        exam_end_time: "",
        interval: "",
        hours: "",
        minutes: "",
        seconds: "",
        questions: [
          {
            examination_id: "",
            order: "",
            content: "",
            options: [
              {
                key: "",
                value: "",
              },
            ],
          }
        ],
        questionIndex: 0,
        answer: "",
        answers: [],
        clicked: [],
      }
    },
    mounted() {
      this.loadExaminationQuestions();
      console.log("Online Examination Component Mounted.");
      const monthNames = ["", "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"];

      //new Date('April 15, 2021 17:00:00 GMT+03:00')
      this.exam_start_time = new Date(''+ monthNames[new Date(this.examination.exam_date).getMonth() + 1] +' '+ new Date(this.examination.exam_date).getDate() +', '+ new Date(this.examination.exam_date).getFullYear() +' '+ this.examination.exam_start_time +' GMT+03:00').getTime();
      this.exam_end_time = new Date(''+ monthNames[new Date(this.examination.exam_date).getMonth() + 1] +' '+ new Date(this.examination.exam_date).getDate() +', '+ new Date(this.examination.exam_date).getFullYear() +' '+ this.examination.exam_end_time +' GMT+03:00').getTime();

      this.timer(this.exam_start_time,this.exam_end_time);
      this.interval = setInterval(() => {
          this.timer(this.exam_start_time,this.exam_end_time);
      }, 1000);
    },
    methods:{
      timer: function(exam_start_time,exam_end_time){
        var now = new Date().getTime();

        var start = exam_start_time - now;
        var end = exam_end_time - now;

        if(start < 0 && end < 0){
          clearInterval(this.interval);
          this.submitForm();
        }
        else if(start < 0 && end > 0){
          this.calculateTime(end);
        }
        else if(start > 0 && end > 0){
          window.location.href = '/exams/list';
        }
      },
      calculateTime(dist){
        this.hours = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        this.minutes = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
        this.seconds = Math.floor((dist % (1000 * 60)) / 1000);
      },
      submitForm(){
        axios.post('/api/v1/exams/store-online-exam',{answers: this.answers,examinationId: this.examination.id,userId: this.user})
             .then((response) => {
               console.log('success');
               Swal.fire({
                 position: 'top',
                 icon: 'success',
                 title: 'Gönderildi',
                 text: 'Sınavınız başarıyla gönderilmiştir',
                 showConfirmButton: false,
                 timer: 3000
              })
              setTimeout(() => {
                window.location.href = '/exams/list';
              }, 3000);
             })
             .catch((error) => {
               Swal.fire({
                position: 'top',
                icon: 'error',
                title: 'Hata',
                text: 'Hatalı işlem',
                timer: 1500
              })
               console.log('Error submitForm failed!');
             });
      },
      pickAnswer: function (event) {
        this.answer = event.target.value;
      },
      saveAnswer(questionIndex){
        if (this.answer !== "" && !this.clicked.includes(questionIndex)) {
          this.answers.push(
            {
              questionIndex: questionIndex,
              questionAnswer: this.answer,
            }
          ),
          this.answer = "";
          this.clicked.push(questionIndex);
        }
        else if (this.clicked.includes(questionIndex)) {
          Swal.fire({
           position: 'top',
           icon: 'error',
           title: 'Hata',
           text: 'Bu soruyu daha önce cevapladınız',
         })
        }
        else {
          Swal.fire({
           position: 'top',
           icon: 'error',
           title: 'Hata',
           text: 'Şık seçimi yapınız',
         })
        }
      },
      pickQuestion(index){
        this.answer = "";
        this.questionIndex = index;
      },
      loadExaminationQuestions(){
        axios.get('/api/v1/exams/examination/'+ this.examination.id +'/load-examination-questions')
             .then((response) => {
                 this.questions = response.data.data;
                 console.log("loadExaminationQuestions successful");
             })
             .catch((error) => {
               console.log("Error loadExaminationQuestions failed!");
             });
      },
    }
  }
</script>
