# Stage 1: Build the web app
FROM node:lts as builder
WORKDIR /app
COPY ./src/vue/package*.json ./
COPY ./src/vue/yarn.lock ./
RUN yarn install
COPY ./src/vue .
RUN yarn build

# Stage 2: Create the production image
FROM nginx:latest
COPY --from=builder /app/dist /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
