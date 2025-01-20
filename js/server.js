import axios from "axios";

const app = axios.create({
  baseURL: `http://${process.env.HOST}/intra-amcel-web`,
});

export default app;