<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">/newsite</th>
          <th scope="col">/newsell</th>
          <th scope="col">/articles</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in week">
          <th scope="row">{{ item.day }}</th>
          <td>{{ item.newsite }}</td>
          <td>{{ item.newsell }}</td>
          <td>{{ item.articles }}</td>
          <td>{{ item.total }}</td>
        </tr>
        <tr>
          <th scope="row">Total</th>
          <td>{{ newsiteTotal }}</td>
          <td>{{ newsellTotal }}</td>
          <td>{{ articlesTotal }}</td>
          <td>{{ total }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentDate: new Date(),
      week: [],
      newsiteTotal: 0,
      newsellTotal: 0,
      articlesTotal: 0,
      total: 0
    };
  },
  methods: {
    formatDate: function(date) {
      let dd = String(date.getDate()).padStart(2, "0");
      let mm = String(date.getMonth() + 1).padStart(2, "0"); //January is 0!
      let yyyy = date.getFullYear();
      return yyyy + "-" + mm + "-" + dd;
    },
    getTotalURL: function(url) {
      var result = 0;
      url = encodeURIComponent(url);
      console.log(url);
      axios
        .get(`/api/statistics/url/${url}`)
        .then(response => {
          return response.data;
        })
        .catch(reason => {
          console.log(reason);
        });
      return result;
    },
    getTotalDate: function(date) {
      var result = 0;
      axios
        .get(`/api/statistics/date/${date}`)
        .then(response => {
          return response.data;
        })
        .catch(reason => {
          console.log(reason);
        });
      return result;
    },
    getDateURL: function(date, url) {
      url = encodeURIComponent(url);
      var result = 0;
      axios
        .get(`/api/statistics/date/${date}/url/${url}`)
        .then(response => {
          return response.data;
        })
        .catch(reason => {
          console.log(reason);
        });
      return result;
    }
  },
  created: function() {
    this.newsiteTotal = this.getTotalURL("newsite");
    this.newsellTotal = this.getTotalURL("newsell");
    this.articlesTotal = this.getTotalURL("articles");
    this.total = this.newsiteTotal + this.newsellTotal + this.articlesTotal;

    for (let i = 0; i < 2; i++) {
      let formattedDate = this.formatDate(this.currentDate);
      let item = {
        day: formattedDate,
        newsite: this.getDateURL(formattedDate, "newsite"),
        newsell: this.getDateURL(formattedDate, "newsell"),

        articles: this.getDateURL(formattedDate, "articles"),
        total: this.getTotalDate(formattedDate)
      };
      this.week.push(item);
      this.currentDate.setDate(this.currentDate.getDate() - 1);
    }
  }
};
</script>