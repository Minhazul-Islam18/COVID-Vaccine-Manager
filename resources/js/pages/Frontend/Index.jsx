import { Text } from '@mantine/core';
import FrontendLayout from '@/layouts/FrontendLayout';

const Home = () => {
  return (
    <>
      <Text>Home</Text>
    </>
  );
};

Home.layout = page => <FrontendLayout title='Home'>{page}</FrontendLayout>;

export default Home;
