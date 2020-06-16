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
      url = encodeURIComponent(url);
      return axios.get(`/api/statistics/url/${url}`).then(response => {
        return response.data;
      });
    },
    getTotalDate: function(date) {
      return axios.get(`/api/statistics/date/${date}`).then(response => {
        return response.data;
      });
    },
    getDateURL: function(date, url) {
      url = encodeURIComponent(url);
      return axios
        .get(`/api/statistics/date/${date}/url/${url}`)
        .then(response => {
          return response.data;
        });
    }
  },
  created: function() {
    this.getTotalURL("newsite").then(data => (this.newsiteTotal = data));
    this.getTotalURL("newsell").then(data => (this.newsellTotal = data));
    this.getTotalURL("articles").then(data => (this.articlesTotal = data));
    this.total = "#";

    for (let i = 0; i < 7; i++) {
      let formattedDate = this.formatDate(this.currentDate);
      let item = {
        day: formattedDate,
        newsite: 0,
        newsell: 0,
        articles: 0,
        total: 0
      };
      this.getDateURL(formattedDate, "newsite").then(
        data => (item.newsite = data)
      );
      this.getDateURL(formattedDate, "newsell").then(
        data => (item.newsell = data)
      );
      this.getDateURL(formattedDate, "articles").then(
        data => (item.articles = data)
      );
      this.getTotalDate(formattedDate).then(data => (item.total = data));
      this.week.push(item);
      this.currentDate.setDate(this.currentDate.getDate() - 1);
    }
  }
};
</script>