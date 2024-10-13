import Layout from '@/layouts/MainLayout';
import { Title } from '@mantine/core';

const Dashboard = () => {
  return (
    <>
      <Title mb='xl'>Dashboard</Title>
    </>
  );
};

Dashboard.layout = page => <Layout title='Dashboard'>{page}</Layout>;

export default Dashboard;
