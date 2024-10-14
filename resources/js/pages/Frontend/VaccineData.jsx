import React, { useState } from 'react';
import { TextInput, Button, Text, Container, Notification, Loader, Alert } from '@mantine/core';
import { showNotification } from '@mantine/notifications';
import axios from 'axios';
import FrontendLayout from '@/layouts/FrontendLayout';
import { Link } from '@inertiajs/react';

const VaccineData = () => {
  const [nid, setNid] = useState('');
  const [status, setStatus] = useState('');
  const [scheduledDate, setScheduledDate] = useState('');
  const [vaccinationCenter, setVaccinationCenter] = useState(null);
  const [loading, setLoading] = useState(false);

  const formattedStatus = text => {
    return text.replace(/_/g, ' ');
  };

  const handleSearch = async e => {
    e.preventDefault();
    setLoading(true);

    try {
      const response = await axios.get('/api/vaccine-status', { params: { nid } });
      setStatus(response.data.status);
      setScheduledDate(response.data.scheduled_date || '');
      setVaccinationCenter(response.data?.vaccineCenter || '');
      console.log(response.data.status);

      switch (response.data.status) {
        case 'not_scheduled':
          showNotification({
            title: 'Info',
            message: "You are registered. Please be patient, You'll be scheduled.",
            color: 'indigo',
          });
          break;
        case 'scheduled':
          showNotification({
            title: 'Info',
            message: 'You are Scheduled. Keep eye on scheduled date.',
            color: 'green',
          });
          break;
        case 'vaccinated':
          showNotification({
            title: 'Info',
            message: "You're already vaccinated, Stay safe",
          });
          break;

        case 'not_registered':
          showNotification({
            title: 'Info',
            message: 'You are not registered. Please register first.',
            color: 'yellow',
          });
          break;
      }
    } catch (error) {
      console.error('Error fetching vaccine status:', error);
      showNotification({
        title: 'Error',
        message: 'An error occurred while fetching the vaccine status.',
        color: 'red',
      });
    } finally {
      setLoading(false);
    }
  };

  return (
    <Container
      size='xs'
      padding='md'
    >
      <h1>Check Your Vaccine Status</h1>
      <form onSubmit={handleSearch}>
        <TextInput
          label='Enter Your NID'
          value={nid}
          onChange={e => setNid(e.target.value)}
          required
        />
        <Button
          type='submit'
          loading={loading}
          mt='md'
        >
          Check Status
        </Button>
      </form>
      {status && (
        <Alert
          title='Vaccination Status'
          color={status === 'not_registered' ? 'red' : 'blue'}
          withCloseButton={false}
          style={{ marginTop: '20px' }}
        >
          <Text size='lg'>
            Status: <span style={{ textTransform: 'capitalize' }}>{formattedStatus(status)}</span>
          </Text>

          {status === 'scheduled' && (
            <>
              <Text mt='sm'>Your vaccination date is scheduled for: {scheduledDate}</Text>
              <Text mt='sm'>Vaccination center: {vaccinationCenter}</Text>
            </>
          )}

          {status === 'not_registered' && (
            <Text mt='sm'>
              <Link href='/vaccine-manager/register'>Click here to register.</Link>
            </Text>
          )}
        </Alert>
      )}
      {/* {loading && <Loader />} */}
    </Container>
  );
};
VaccineData.layout = page => <FrontendLayout title='Vaccination data'>{page}</FrontendLayout>;

export default VaccineData;
