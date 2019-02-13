<script>
import { Bar } from "vue-chartjs";

const datasets = [
  {
    label: "Uitkomst Test Watmijligt",
    backgroundColor: "rgba(255,255,255,.3)",
    borderColor: "transparent",
    data: []
  }
];

export default {
  extends: Bar,
  props: ["height"],
  mounted() {
    this.renderChart(
      {
        labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", "", ""],
        datasets: datasets
      },
      {
        maintainAspectRatio: false,
        legend: { display: false },
        scales: {
          xAxes: [
            {
              display: false,
              categoryPercentage: 1,
              barPercentage: 0.5
            }
          ],
          yAxes: [{ display: false }]
        }
      }
    );
  }
};
</script>
