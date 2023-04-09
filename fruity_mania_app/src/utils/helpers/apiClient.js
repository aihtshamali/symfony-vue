import axios from "axios";

export default {
  get(endpoint) {
    return new Promise((resolve, reject) => {
      axios
        .get(endpoint)
        .then((response) => {
          resolve(response);
        })
        .catch((error) => {
          const response = error.response;
          if (axios.isCancel(error)) {
            reject(response);
          }
        });
    });
  },
};
