<template>
  <div>
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
            <input type="radio" name="question_answer" @change="pickAnswer" :value="option['value']">
            {{option['key']}}) {{option['value']}}
            <br>
          </div>
          <br>
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-outline-light" style="background:#2AC020" @click="saveAnswer(questionIndex)">Cevabı Kaydet</button>
            <button type="button" class="btn btn-primary btn-outline-light">Sınavı bitir ve Gönder</button>
          </div>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
import axios from "axios";
import Swal from 'sweetalert2';
Vue.prototype.$eventBus = new Vue();

  export default {
    props: [
      'examination'
    ],
    data() {
      return {
        questionIndex: 0,
        answer: "",
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
        answers: [],
        clicked: [],
      }
    },
    mounted() {
      this.loadExaminationQuestions();
      console.log("Online Examination Component Mounted.");
    },
    methods:{
      pickAnswer: function (event) {
        this.answer = event.target.value;
      },
      saveAnswer(questionIndex){
        if (this.answer !== "") {
          this.answers.push(
            {
              questionIndex: questionIndex,
              questionAnswer: this.answer,
            }
          ),
          this.answer = "";
          this.clicked.push(questionIndex);
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
