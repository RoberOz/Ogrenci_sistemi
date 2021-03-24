<template>
  <div>
    <!-- <form method="post" action="{{url('exams/modify-exam-store')}}"> -->
    <form v-on:submit.prevent="submitForm">
      <div class="list-group col" id="examinationQuestions">
        <button type="button" class="btn btn-primary btn-outline-light" style="width:150px;" @click="addNewQuestion()">Soru Ekle</button>
        <br>
        <draggable ghost-class="ghost" @end="onEnd" :options="{animation:200}">
          <transition-group type="transition">
            <div v-for="(question,index) in questions" :key="index">
              <div v-if="(question.examination_id == examination.id) || question.examination_id == '' ">
                <div class="list-group-item">
                  <textarea rows="2" cols="80" v-model="question.content" @change="findExamId(index,examination.id)"></textarea>
                  <button type="button" class="btn btn-primary btn-outline-light" style="background:#B60C09" @click="deleteQuestion(index)">Soruyu Sil</button>
                  <div v-for="option in question.options">
                    <input type="text" v-model="option.key" @change="findExamId(index,examination.id)" style="width:30px;"> :
                    <input type="text" v-model="option.value" @change="findExamId(index,examination.id)">
                    <button type="button" class="btn btn-primary btn-outline-light btn-sm" style="background:#B60C09" @click="deleteQuestionOption(index)">X</button>
                    <br><br>
                  </div>
                  <button type="button" class="btn btn-primary btn-outline-light" style="width:150px;" @click="addNewQuestionOption(index)">Şık Ekle</button>
                </div>
              </div>
            </div>
          </transition-group>
        </draggable>
      </div>
      <br>
      <div align="center">
        <button type="submit" class="btn btn-primary btn-outline-light" style="background:#19A713;">Kaydet</button>
      </div>
    </form>
    <p><strong>Previous Index:</strong> {{oldIndex}} </p>
    <p><strong>New Index:</strong> {{newIndex}} </p>
  </div>
</template>

<script>
import axios from "axios";
import draggable from 'vuedraggable';
import Swal from 'sweetalert2';

    export default {
        props: [
          'examinationquestions',
          'examination'
        ],
        components: {
          draggable,
        },
        data() {
          return {
            oldIndex: "",
            newIndex: "",
            questions: [
              {
                examinationQuestionId:"",
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
          }
        },
        mounted() {
            this.loadExaminationQuestions();
            console.log('Examination Form Component Mounted.');
        },
        methods:{
          addNewQuestion(){
            this.questions.push({
                            examinationQuestionId:"",
                            examination_id:"",
                            order: "",
                            content: "",
                            options: [
                              {
                                key: "",
                                value: "",
                              },
                            ],
                          });
          },
          deleteQuestion(index){
            this.questions.pop();
          },
          addNewQuestionOption(index){
            this.questions[index].options.push({
                                key: "",
                                value: "",
                              },);
          },
          deleteQuestionOption(index){
            this.questions[index].options.pop();
          },
          submitForm(){
            axios.post('/api/v1/exams/modify-exam-store',this.questions)
                 .then((response) => {
                   Swal.fire({
                     position: 'top-end',
                     icon: 'success',
                     title: 'Sınav başarıyla kaydedildi',
                     showConfirmButton: false,
                     timer: 1500,
                    });
                    //examination_idlocation.reload();
                   console.log('success');
                 })
                 .catch((error) => {
                   Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Hata',
                    text: 'Eksik veya hatalı giriş yaptınız!',
                  })
                   console.log('Error submitForm failed!');
                 });
          },
          onEnd: function(evt) {
            console.log(evt);
            console.log("evt.oldIndex: " + evt.oldIndex);
            console.log("evt.newIndex: " + evt.newIndex);
            this.questions[evt.oldIndex].order = evt.newIndex;
            this.questions[evt.newIndex].order = evt.oldIndex;

            this.oldIndex = evt.oldIndex;
            this.newIndex = evt.newIndex;
          },
          findExamId(index,id) {
            this.questions[index].examination_id = id;
          },
          loadExaminationQuestions(){
            axios.get('/api/v1/exams/load-examination-questions')
                 .then((response) => {
                     this.questions = response.data.data;
                     console.log("loadExaminationQuestions successful");
                 })
                 .catch((error) => {
                   console.log('Error loadExaminationQuestions failed!');
                 });
          },
        },
    }
</script>

<style>
.ghost {
  opacity: 0.5;
  background: #c8ebfb;
  border-left: 6px solid rgb(0,183,255);
}
</style>
