const {
  public: { baseApi },
} = useRuntimeConfig();

export const getHistories = () => {
  const { user, isSeller } = useAuthStore();

  const run = async () => {
    let url = `${baseApi}/orderHistory`;
    if (isSeller()) url = `${baseApi}/orderHistory/seller`;

    const res = await $fetch(url, {
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("List History error");
  };

  return { run };
};

export const getHistory = () => {
  const { user } = useAuthStore();
  const uri = ref({
    orderHistoryId: null,
  });

  const run = async () => {
    const res = await $fetch(
      `${baseApi}/orderHistoryDetail/${uri.value.orderHistoryId}`,
      {
        headers: {
          Authorization: `Bearer ${user.token}`,
        },
      }
    );

    if (res) return res;
    throw new Error("Detail History error");
  };

  return { uri, run };
};
