<template>
  <div>
    <div v-for="examinationquestion in examinationquestions">
      <table>
        <tr>
          <td>
            {{examinationquestion.order}})
            {{examinationquestion.content}}<br>
          </td>
        </tr>
        <tr>
          <td>
            <div v-for="option in examinationquestion.options">
              <input type="radio" name="question_answer">
              {{option['key']}}) {{option['value']}}
              <br>
            </div>
            <br>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";

  export default {
    props: [
      'examinationquestions'
    ],
    data() {
      return {
      }
    },
    mounted() {
        console.log('Online Examination Component Mounted.');
    },
  }
</script>
