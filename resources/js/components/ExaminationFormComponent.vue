<template>
  <div>
    <div v-if="modifyAllowed === true">
      <form v-on:submit.prevent="submitForm">
        <div class="list-group col" id="examinationQuestions">
          <div class="row">
            <div class="col">
              <button type="button" class="btn btn-primary btn-outline-light" style="width:150px;" @click="addNewQuestion(),manageOrder()">Soru Ekle</button>
            </div>
          </div>
          <br>
          <draggable :list="questions" ghost-class="ghost" @end="manageOrder" :options="{animation:200}">
            <transition-group type="transition">
              <div v-for="(question,index) in questions" :key="index">
                <div class="list-group-item">
                  <textarea rows="2" cols="80" v-model="question.content"></textarea>
                  <button type="button" class="btn btn-primary btn-outline-light" style="background:#B60C09" @click="deleteQuestion(index)">Soruyu Sil</button>
                  <div v-for="(option,indexOption) in question.options">
                    <input type="text" v-model="option.key" style="width:30px;"> :
                    <input type="text" v-model="option.value">
                    <button type="button" class="btn btn-primary btn-outline-light btn-sm" style="background:#B60C09" @click="deleteQuestionOption(index,indexOption)">X</button>
                    <br><br>
                  </div>
                  <button type="button" class="btn btn-primary btn-outline-light" style="width:150px;" @click="addNewQuestionOption(index)">Şık Ekle</button>
                </div>
              </div>
            </transition-group>
          </draggable>
        </div>
        <br>
        <div align="center">
          <input type="hidden" ref="examId" :value="examination.id">
          <button type="submit" class="btn btn-primary btn-outline-light" style="background:#19A713;">Kaydet</button>
        </div>
      </form>
    </div>
    <div align="center" v-else>
      <strong style="color:#EA1D1D">
        <i class="fas fa-exclamation"></i><i class="fas fa-exclamation"></i><i class="fas fa-exclamation"></i>
         Sınav başlamış veya bitmiş olduğundan sorular üzerinde değişiklik yapamazsınız
      </strong>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import draggable from 'vuedraggable';
import Swal from 'sweetalert2';
import moment from 'moment';

    export default {
        props: [
          'examination'
        ],
        components: {
          draggable,
        },
        data() {
          return {
            modifyAllowed: "",
            questions: [
              {
                examination_id:"",
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
            this.examModify();
            console.log('Examination Form Component Mounted.');
        },
        methods:{
          examModify(){
            const monthNames = ["", "January", "February", "March", "April", "May", "June",
              "July", "August", "September", "October", "November", "December"];

            var exam_start = new Date(''+ monthNames[new Date(this.examination.exam_date).getMonth() + 1] +' '+ new Date(this.examination.exam_date).getDate() +', '+ new Date(this.examination.exam_date).getFullYear() +' '+ this.examination.exam_start_time +' GMT+03:00');

            if (moment()._d > exam_start)
            {
              this.modifyAllowed = false;
              console.log('Modify not allowed.');
            }
            else
            {
              this.modifyAllowed = true;
              console.log('Modify allowed.');
            }
          },
          addNewQuestion(){
            this.questions.push({
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
            this.questions.splice(index,1);
          },
          addNewQuestionOption(index){
            this.questions[index].options.push({
                                key: "",
                                value: "",
                              },);
          },
          deleteQuestionOption(index,indexOption){
            this.questions[index].options.splice(indexOption,1);
          },
          submitForm(){
            let examinationId = this.$refs.examId.value;
            axios.post('/api/v1/exams/'+ examinationId +'/modify-exam-store',this.questions)
                 .then((response) => {
                   Swal.fire({
                     position: 'top-end',
                     icon: 'success',
                     title: 'Sınav başarıyla kaydedildi',
                     showConfirmButton: false,
                     timer: 1500,
                    });
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
          manageOrder: function(evt) {
            this.questions.map((question,index) => {
              question.order = index + 1;
            })
          },
          loadExaminationQuestions(){
            axios.get('/api/v1/exams/examination/'+ this.examination.id +'/load-examination-questions')
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
